import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import Embed from "@editorjs/embed";
import Delimiter from "./Delimiter";
import ImageTool from "./ImageTool";
import CodeTool from "./CodeTool";
import VideoTool from "./VideoTool";
import edjsHTML from "editorjs-html";

document.addEventListener("DOMContentLoaded", function() {
    const editorHolder = document.getElementById('editorjs');
    // alert(editorHolder)
    if (editorHolder) {
        const editor = new EditorJS({
            holder: "editorjs",
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true,
                    config: {
                        placeholder: "Title",
                    },
                },
                list: {
                    class: List,
                    inlineToolbar: ["link", "bold"],
                },
                embed: {
                    class: Embed,
                    inlineToolbar: false,
                    config: {
                        youtube: true,
                    },
                },
                code: CodeTool,
                delimiter: Delimiter,
                image: ImageTool,
                video: VideoTool,
            },
            autofocus: true,
            placeholder: "Start writing...",
            data: {
                blocks: [
                    {
                        type: "header",
                        data: {
                            text: "",
                            level: 2,
                        },
                    },
                ],
            },
        });

        const saveBtn = document.getElementById("save-article-btn");
        if (saveBtn) {
            saveBtn.addEventListener("click", () => {
                editor.save().then((outputData) => {
                    const edjsParser = edjsHTML(customParsers);
                    const html = edjsParser.parse(outputData);
                    const htmlContent = html.join("");

                    console.log("HTML content", htmlContent);
                }).catch((error) => {
                    console.log("Saving failed:", error);
                });
            });
        } else {
            console.error('Element with ID "save-article-btn" is missing.');
        }
    } else {
        console.error('Element with ID "editorjs" is missing.');
    }
});

const customParsers = {
    image: (block) => {
        const { url, caption } = block.data;
        return `
        <div class="image-tool">
            <img src="${url}" alt="${caption || ""}" style="max-width: 100%; height: auto;">
            ${caption ? `<p>${caption}</p>` : ""}
        </div>
        `;
    },
    video: (block) => {
        const { src, caption } = block.data;
        return `
        <div class="video-tool">
            <video src="${src}" controls style="max-width: 100%; height: auto;"></video>
            ${caption ? `<p>${caption}</p>` : ""}
        </div>
        `;
    },
    code: (block) => {
        const { code, language } = block.data;
        const languageClass = language ? `language-${language.toLowerCase()}` : "";
        return `
        <pre class="ce-code-tool">
            <div class="ce-code-tool__language">${language}</div>
            <div class="${languageClass}">${code}</div>
        </pre>
        `;
    },
    delimiter: (block) => {
        return `
        <div class="ce-delimiter">. . .</div>
        `;
    },
    list: (block) => {
        const { style, items } = block.data;
        const listItems = items.map((item) => `<li>${item}</li>`).join("");
        return `
        <${style === "ordered" ? "ol" : "ul"} class="ce-list">${listItems}</${style === "ordered" ? "ol" : "ul"}>
        `;
    },
};
