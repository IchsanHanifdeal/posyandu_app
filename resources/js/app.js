import './bootstrap';
import { Designer } from '@pdfme/ui';
import { generate } from '@pdfme/generator';

window.transformData = (arr = []) => {
  const toRemove = new Set();
  const result = arr.reduce((acc, item) => {
    if (item.startsWith('_')) return acc;

    const [base, sub] = item.split('>');
    if (sub) {
      acc.push([base, sub]);
      toRemove.add(base);
    } else if (!toRemove.has(item)) {
      acc.push(item);
    }
    return acc;
  }, []);

  return result.filter(item =>
    typeof item === 'string' ? !toRemove.has(item) : true
  );
}

const font = {
  lucida: {
    data: 'https://fonts.cdnfonts.com/s/16217/LSANSD.woff',
    fallback: true
  },
};

window.setupRenderListing = ({ id }) => {
  const formatLabel = (label) => label.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());

  const container = document.querySelector(`#${id} #container`);
  const listing = transformData(Object.keys(window[id]));

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

  await setupPDFGenerate({ file, schemas: window[schemas], inputs: data });
}

window.setupPDFGenerate = async ({ file, schemas, inputs }) => {
  const api = await fetch('/pdf/base64?path=/docs/' + file)
  const res = await api.json();

  const template = { basePdf: res.base64, schemas: [schemas] };

  generate({ template, inputs: [inputs], options: { font } }).then((pdf) => {
    const blob = new Blob([pdf.buffer], { type: 'application/pdf' });
    window.open(URL.createObjectURL(blob), '_blank');
  });
}
