import './bootstrap';

window.formatLabel = (label) => {
    return label.toLowerCase().replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
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
                name: item,
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
                checked: false,
                id: key,
                name: item,
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
                name: item,
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
                name: item,
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

window.downloadDocs = async ({ file, payload, fileTitle = 'output' }) => {
    const doc = await extractDocx({ file })
    doc.render(payload);

    const blob = doc.getZip().generate({
        type: "blob",
        mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        compression: "DEFLATE",
    });

    saveAs(blob, fileTitle + ".docx");
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

window.pdfToImg = async (url, id) => {
    pdfjsLib.getDocument(url).promise.then(pdf => {
        pdf.getPage(1).then(page => {
            const scale = 1.5
            const viewport = page.getViewport({ scale })
            const canvas = document.getElementById(id)
            const context = canvas.getContext('2d')
            canvas.height = viewport.height
            canvas.width = viewport.width
            page.render({ canvasContext: context, viewport })
        })
    })
}

window.loadSurat = async ({ api, pdfUrl, container }) => {
    var api = await fetch(api)
    var res = await api.json()

    for (let i = 0; i < res.lists.length; i++) {
        const item = res.lists[i]
        const title = formatLabel(item.split('.pdf')[0].replaceAll(/[_|-]/ig, ' '))
        const pdfUri = pdfUrl + `/${item}`

        await pdfToImg(pdfUri, `pdf-preview-` + i)

        container.innerHTML += `
        <tr>
            <td class="text-center">${i + 1}</td>
            <td class="text-center font-semibold">${title}</td>
            <td class="text-center capitalize">
            <label for="output_surat_${i}" class="w-full mx-auto btn btn-neutral flex items-center justify-center gap-2 text-white font-bold">
                Lihat
            </label>
            <input type="checkbox" id="output_surat_${i}" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                <h3 class="text-lg font-bold">${title}</h3>
                <div class="flex flex-col w-full gap-3 !h-full mt-3 rounded-lg overflow-hidden">
                    <canvas id="pdf-preview-${i}" class="border size-full"></canvas>
                </div>
                </div>
                <label class="modal-backdrop" for="output_surat_${i}"></label>
            </div>
            </td>
      </tr>
    `
    }
}
