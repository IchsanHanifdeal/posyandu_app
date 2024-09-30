import express from "express";
import multer from "multer";
import fetch from "node-fetch";
import FormData from "form-data";

const app = express();
app.use(express.json());

let init_cookie = "pdf24FtSid=fnufc28g4r9culgacq29m5hnqe";
const sleep = async (s) => await new Promise((r) => setTimeout(r, s));

const upload = multer();

app.get("/", (req, res) => {
    res.send({
        ok: true,
    });
});

app.post("/pdf/docx", async (req, res) => {
    const { blob } = req.body;

    const formData = new FormData();
    formData.append("file", blob, `file_${Math.random().toString(36).substr(2, 9)}.docx`);

    let ck = "pdf24FtSid=fnufc28g4r9culgacq29m5hnqe";
    let headers = {
        Cookie: ck,
    };

    let uploadResponse = await fetch(
        "https://filetools23.pdf24.org/client.php?action=upload",
        {
            method: "POST",
            body: formData,
            headers: headers,
        }
    );

    let tempFile = await uploadResponse.json();

    let convert = await fetch(
        "https://filetools23.pdf24.org/client.php?action=convertToPdf",
        {
            method: "POST",
            body: JSON.stringify({
                files: tempFile,
                language: "id",
            }),
            headers: {
                "Content-Type": "application/json",
                Cookie: ck,
            },
        }
    );

    const { jobId } = await convert.json();
    let status;
    do {
        const output = await fetch(
            `https://filetools23.pdf24.org/client.php?action=getStatus&jobId=${jobId}`,
            {
                headers: { Cookie: ck },
            }
        );
        status = await output.json();
        await sleep(1000);
    } while (status.status !== "finished");

    const download = await fetch(
        `https://filetools23.pdf24.org/client.php?action=download&jobId=${jobId}`,
        {
            headers: { Cookie: ck },
        }
    );

    const buffer = await download.arrayBuffer();
    const fileName = `converted_${Math.random().toString(36).substr(2, 9)}.pdf`;

    // res.setHeader("Content-Disposition", `attachment; filename=${fileName}`);
    // res.setHeader("Content-Type", "application/pdf");
    // res.send(Buffer.from(buffer));
    res.send({ok: 'ttete'});
});

app.listen(8080, () => {
    console.log("Server running on port 8080");
});

export default app;
