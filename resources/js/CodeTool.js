export default class CodeTool {
    static get isReadOnlySupported() {
        return true;
    }
    //using constructor to exploit the inbuilt functions of the source code of editor JS
    constructor({ data, config, api }) {
        this.data = data;
        this.api = api;
        this.config = config || {};
        this.placeholder = this.config.placeholder || "Enter your code here";
        this.languages = [
            { value: "Javascript", label: "JavaScript" },
            { value: "C++", label: "C++" },
            { value: "Java", label: "Java" },
            { value: "C#", label: "C#" },
            { value: "C", label: "C" },
            { value: "Typescript", label: "Typrescript" },
            { value: "CSS", label: "CSS" },
            { value: "Dart", label: "Dart" },
            { value: "Go", label: "Go" },
            { value: "Bash", label: "Bash" },
            { value: "PHP", label: "PHP" },
            { value: "HTML", label: "HTML" },
        ];

        this.codeArea = null;
        this.languageDropdown = null;
        this.wrapper = null;
    }

    render() {
        this.wrapper = document.createElement("div");
        this.wrapper.classList.add("ce-code-tool");

        this.languageDropdown = document.createElement("select");
        this.languageDropdown.classList.add("ce-code-tool__dropdown");
        this.languages.forEach((lang) => {
            const option = document.createElement("option");
            option.value = lang.value;
            option.textContent = lang.label;
            this.languageDropdown.appendChild(option);
        });

        this.codeArea = document.createElement("textarea");
        this.codeArea.classList.add("ce-code-tool__textarea");
        this.codeArea.placeholder = this.placeholder;
        this.codeArea.value = this.data.code || "";

        this.wrapper.appendChild(this.languageDropdown);
        this.wrapper.appendChild(this.codeArea);

        this.api.listeners.on(this.wrapper, "block:switch", () => {
            this.languageDropdown.style.display = "none";
        });

        this.api.listeners.on(this.wrapper, "block:focus", () => {
            this.languageDropdown.style.display = "block";
        });
        // for handling the case that pressing enter doesnt switch to next block from current block
        this.codeArea.addEventListener("keydown", (event) => {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                event.stopPropagation();

                const { selectionStart, selectionEnd } = this.codeArea;
                const value = this.codeArea.value;
                this.codeArea.value = `${value.substring(
                    0,
                    selectionStart
                )}\n${value.substring(selectionEnd)}`;
                this.codeArea.selectionStart = this.codeArea.selectionEnd =
                    selectionStart + 1;
            }

            if (
                event.key === "Backspace" &&
                this.codeArea.value.trim() === ""
            ) {
                event.preventDefault();
                this.api.blocks.delete();
            }
        });

        return this.wrapper;
    }

    save() {
        return {
            code: this.codeArea.value,
            language: this.languageDropdown.value,
        };
    }
    // for inserting the tool icon to the toolbar
    static get toolbox() {
        return {
            icon: '<?xml version="1.0" ?><svg class="bi bi-journal-code" fill="currentColor" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z" fill-rule="evenodd"/><path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/><path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/></svg>',
            title: "Code Tool",
        };
    }
}
