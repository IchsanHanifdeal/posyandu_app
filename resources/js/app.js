import './bootstrap';
import { generate } from '@pdfme/generator';
import { Designer, Form } from "@pdfme/ui";
import Docxtemplater from 'docxtemplater'
import PizZip from 'pizzip'

const font = {
  lucida: {
    data: 'https://fonts.cdnfonts.com/s/16217/LSANSD.woff',
    fallback: true
  },
};

window.transformData = (input) => {
  const result = [];
  const groups = new Map();

  for (const item of input) {
    if (item.includes('>')) {
      const [groupKey, ...subKeys] = item.split('>');
      if (!groups.has(groupKey)) {
        groups.set(groupKey, new Set([groupKey, ...subKeys]));
      } else {
        subKeys.forEach(key => groups.get(groupKey).add(key));
      }
    }
  }

  for (const item of input) {
    if (item.includes('>')) {
      const [groupKey] = item.split('>');
      if (!result.some(r => Array.isArray(r) && r[0] === groupKey)) {
        result.push([...groups.get(groupKey)]);
      }
    } else if (!Array.from(groups.values()).some(group => group.has(item))) {
      result.push(item);
    }
  }

  return result
}

window.generatePDF = ({ template, inputs }) => {
  console.log("🚀 ~ inputs:", inputs)
  console.log("🚀 ~ template:", template)
  generate({ template, inputs: [inputs], options: { font } }).then((pdf) => {
    const blob = new Blob([pdf.buffer], { type: 'application/pdf' });
    window.open(URL.createObjectURL(blob), '_blank');
  });
}

window.formatLabel = (label) => label.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());

window.setupRenderListing = ({ id, lists }) => {

  const container = document.querySelector(`#${id}`);
  const listing = lists

  const renderDatas = (data, parentId = '', parentContainer = null) => {
    const containerEl = parentContainer || container;

    data.forEach(item => {
      if (Array.isArray(item)) {
        const firstItem = item[0];
        const nestedItems = item.slice(1);

        const divRow = document.createElement('div');
        divRow.classList.add('flex', 'gap-2');

        const divCol = document.createElement('div');
        divCol.classList.add('flex', 'flex-col', 'w-full', 'gap-1');

        const label = document.createElement('label');
        label.classList.add('text-sm', 'font-bold');
        label.textContent = formatLabel(firstItem);

        const input = document.createElement('input');
        input.type = 'text';

        const inputId = parentId ? `${parentId}>${firstItem}` : firstItem;
        input.name = inputId;
        input.id = inputId;
        input.classList.add('input', 'input-sm');

        divCol.appendChild(label);
        divCol.appendChild(input);
        divRow.appendChild(divCol);

        containerEl.appendChild(divRow);

        renderDatas(nestedItems, inputId, divRow);
      } else {
        const divCol = document.createElement('div');
        divCol.classList.add('flex', 'flex-col', 'w-full', 'gap-1');

        const label = document.createElement('label');
        label.classList.add('text-sm', 'font-bold');
        label.textContent = formatLabel(item);

        const input = document.createElement('input');
        input.type = 'text';

        const inputId = parentId ? `${parentId}>${item}` : item;
        input.name = inputId;
        input.id = inputId;
        input.classList.add('input', 'input-sm');

        divCol.appendChild(label);
        divCol.appendChild(input);

        containerEl.appendChild(divCol);
      }
    });
  };

  renderDatas(listing);
}

window.setupFormGenerate = async (form, schemas, file) => {

  const formData = new FormData(form);
  const data = Object.fromEntries(formData);

  await setupPDFGenerate({ file, schemas: window[schemas](), inputs: data });
}

window.setupPDFGenerate = async ({ file, schemas, inputs }) => {
  // const api = await fetch('/pdf/base64?path=/docs/' + file)
  // const res = await api.json();
  const template = {
    basePdf: file, schemas: [{
      s: {
        "type": "text",
        "content": " ",
        "position": {
          "x": 27.5,
          "y": 45.90
        },
        "width": 120,
        "height": 4,
        "rotate": 0,
        "alignment": "left",
        "verticalAlignment": "top",
        "fontSize": 9.5,
        "lineHeight": 1,
        "characterSpacing": 0,
        "fontColor": "#2C2E35",
        //   "required": true,
        "fontName": "lucida",
        "backgroundColor": "#E7F4DF"
      }
    }]
  };

  generatePDF({ template, inputs: { s: ' ' } });
}

window.setupPDFDesign = async ({ file, schemas, id }) => {
  const api = await fetch('/pdf/base64?path=/docs/' + file)
  const res = await api.json();

  const template = { basePdf: res.base64, schemas: [window[schemas]()] };

  const domContainer = document.getElementById(id)
  const designer = new Designer({ domContainer, template, options: { font } });

  designer.onChangeTemplate((template) => {
    console.log(JSON.stringify(template.schemas, null, 2));
  })
}

window.setupPDFForm = async ({ file, schemas, id }) => {
  const api = await fetch('/pdf/base64?path=/docs/' + file)
  const res = await api.json();

  const template = { basePdf: res.base64, schemas: [window[schemas]()] };

  const domContainer = document.getElementById(id)
  const form = new Form({ domContainer, template, inputs: [{ saya: '' }], options: { font } });

  return form
}

window.extractDocx = async ({ file }) => {
  const api = await fetch('/pdf/base64?path=' + file)
  const res = await api.json();
  const zip = new PizZip(res.base64, { base64: true });
  const doc = new Docxtemplater(zip, {
    paragraphLoop: true,
    linebreaks: true,
  });

  return {
    getKeys: async () => {
      const data = await doc.resolveData()
      const parse = await data.map(x => x.tag)
      const filter = parse.filter(x => !x.startsWith('%')).map(x => formatLabel(x.replace('_', ' ')))

      return {
        fresh: parse,
        labeling: filter
      }
    },
    renderKeys: (keys) => doc.render(keys),
    getZip: () => doc.getZip()
  }
}
