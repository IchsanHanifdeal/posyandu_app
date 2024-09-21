import './bootstrap';

window.formatLabel = (label) => {
  return label.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
}

window.loadFile = (url, cb) => {
  PizZipUtils.getBinaryContent(url, cb);
}

window.renderFormInputs = (data, id) => {
  const container = document.getElementById(id);
  const createLabel = (forId, text) => {
    const label = document.createElement('label');
    label.htmlFor = forId;
    label.textContent = formatLabel(text)
    label.className = 'labelz'
    return label;
  };
  const createElement = (type, props = {}) => Object.assign(document.createElement(type), props);
  data.forEach(item => {
    const [key, ...rest] = item.split(/[\||\=|\>]/gi);
    const wrapper = createElement('div', {
      className: 'mb-4 form-modal'
    });
    let input;
    if (item.includes('=[')) {
      const options = item.match(/\[(.*?)\]/)[1].split(',');
      input = createElement('select', {
        id: key,
        name: key,
        className: 'selectz'
      });
      options.forEach(opt => input.appendChild(createElement('option', {
        value: opt.trim(),
        textContent: formatLabel(opt.trim())
      })));
    } else if (item.includes('|?(')) {
      const label = item.match(/\?\((.*?)\)/)[1];
      input = createElement('label', {
        htmlFor: key,
      });
      input.appendChild(createElement('input', {
        type: 'checkbox',
        id: key,
        name: key,
        className: 'checkboxz'
      }));
      input.appendChild(createElement('span', {
        textContent: formatLabel(key)
      }));
    } else if (item.includes('|~(')) {
      const label = item.match(/~\((.*?)\)/)[1];
      input = createElement('label', {
        htmlFor: key,
      });
      input.appendChild(createElement('input', {
        type: 'checkbox',
        id: key,
        name: key,
        className: 'switchz'
      }));
      input.appendChild(createElement('span', {
        textContent: formatLabel(key)
      }));
    } else {
      const options = rest.join('|');
      input = createElement('input', {
        type: 'text',
        id: key,
        name: key,
        className: 'inputz',
        required: options.includes('*')
      });
      if (options.includes('>')) {
        const placeholder = options.match(/>(.*)/)[1];
        input.placeholder = placeholder.startsWith('r(') ?
          '.'.repeat(parseInt(placeholder.match(/r\(.,(\d+)\)/)[1])) :
          placeholder;
      }
    }
    if (!item.includes('|?(') && !item.includes('|~(')) {
      wrapper.appendChild(createLabel(key, key));
    }
    wrapper.appendChild(input);
    container.appendChild(wrapper);
  });
}

window.autoFillForm = (data) => {
  Object.keys(data).forEach(key => {
    const input = document.getElementById(key);
    if (input) {
      input.value = data[key];
    }
  });
}

window.parseForm = (form) => {
  const data = new FormData(form);
  const parse = Object.fromEntries(data);
  Object.keys(parse).forEach(key => {
    if (parse[key] === "on") parse[key] = "✓";
    else if (parse[key] === "off") parse[key] = "-";
  });

  console.log("🚀 ~ parse:", parse)
  return parse
}

window.extractDocx = async ({ file }) => {
  const temp = new Promise((resolve, reject) => {
    loadFile(file, (error, content) => {
      if (error) reject(error);
      const zip = new PizZip(content);
      const doc = new window.docxtemplater(zip, {
        paragraphLoop: true,
        linebreaks: true,
      });
      resolve(doc)
    })
  })

  return temp.then(x => x)
}

window.extractDocxKeys = async (doc) => {
  const keys = await doc.resolveData()
  const parse = keys.map(x => x.tag);

  const _original = parse.map(x => x.toLowerCase());
  const _legal = parse.map(x => x.toLowerCase().split(/[\||\=|\>]/)[0]);
  const _label = _legal.filter(x => !x.startsWith('%')).map(x => formatLabel(x.replace('_', ' ')))

  return {
    original: () => _original,
    legal: () => _legal,
    label: () => _label
  }
}

window.extractDocxBlob = async (doc, data) => {
  doc.render(data);

  const blob = doc.getZip().generate({
    type: "blob",
    mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    compression: "DEFLATE",
  });

  return {
    blob: () => blob,
    url: () => URL.createObjectURL(blob)
  }
}
