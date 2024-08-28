var exists = true;
class ImageTool {
    constructor({ data, api, config }) {
        this.api = api;
        this.config = config;
        this.data = data || {};
        this.wrapper = null;
        this.fileInput = null;
        this.captionInput = null;

        this.triggerFileInput();
    }
    //here i have used apis from the source code of  editorJS
    static get toolbox() {
        return {
            title: "Image",
            icon: '<?xml version="1.0" ?><svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M19,6 L19,4 L21,4 L21,6 L23,6 L23,8 L21,8 L21,10 L19,10 L19,8 L17,8 L17,6 L19,6 Z M6.93701956,5.8453758 C7.00786802,5.74688188 7.08655595,5.62630624 7.18689462,5.46372136 C7.24312129,5.37261385 7.44826978,5.03326386 7.48180256,4.97841198 C8.31078556,3.62238733 8.91339479,3 10,3 L15,3 L15,5 L10,5 C9.91327186,5 9.64050202,5.28172235 9.18819752,6.02158802 C9.15916322,6.06908141 8.95096113,6.41348258 8.88887147,6.51409025 C8.76591846,6.71331853 8.66374696,6.86987867 8.56061313,7.0132559 C8.1123689,7.63640757 7.66434207,8 7.0000003,8 L4,8 C3.44771525,8 3,8.44771525 3,9 L3,18 C3,18.5522847 3.44771525,19 4,19 L20,19 C20.5522847,19 21,18.5522847 21,18 L21,12 L23,12 L23,18 C23,19.6568542 21.6568542,21 20,21 L4,21 C2.34314575,21 1,19.6568542 1,18 L1,9 C1,7.34314575 2.34314575,6 4,6 L6.81619668,6 C6.84948949,5.96193949 6.89029794,5.91032846 6.93701956,5.8453758 Z M12,18 C9.23857625,18 7,15.7614237 7,13 C7,10.2385763 9.23857625,8 12,8 C14.7614237,8 17,10.2385763 17,13 C17,15.7614237 14.7614237,18 12,18 Z M12,16 C13.6568542,16 15,14.6568542 15,13 C15,11.3431458 13.6568542,10 12,10 C10.3431458,10 9,11.3431458 9,13 C9,14.6568542 10.3431458,16 12,16 Z" fill-rule="evenodd"/></svg>',
        };
    }

    render() {
        this.wrapper = document.createElement("div");

        if (this.data.url) {
            const img = document.createElement("img");
            img.src = this.data.url;
            img.style.maxWidth = "100%";
            img.style.height = "auto";
            this.wrapper.appendChild(img);

            this.createCaptionInput();
        }

        return this.wrapper;
    }
    //for taking input from window modal
    triggerFileInput() {
        exists = true;
        this.fileInput = document.createElement("input");
        this.fileInput.type = "file";
        this.fileInput.accept = "image/*";
        this.fileInput.style.display = "none";
        this.fileInput.addEventListener("change", (event) =>
            this.uploadImage(event)
        );

        document.body.appendChild(this.fileInput);
        this.fileInput.click();
    }
    //handling image upload
    uploadImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.data.url = e.target.result;
                this.updateView();
                this.focusCaptionInput();
            };
            reader.readAsDataURL(file);
        }
    }
    //updating DOM
    updateView() {
        if (!this.wrapper) {
            this.wrapper = document.createElement("div");
        }
        this.wrapper.innerHTML = "";

        if (this.data.url) {
            const img = document.createElement("img");
            img.src = this.data.url;
            img.style.maxWidth = "100%";
            img.style.height = "auto";
            this.wrapper.appendChild(img);

            this.createCaptionInput();
        }
    }
    //for creating captions
    createCaptionInput() {
        const captionWrapper = document.createElement("div");
        captionWrapper.classList.add("caption-wrapper");

        this.captionInput = document.createElement("input");
        this.captionInput.type = "text";
        this.captionInput.placeholder = "Enter caption (Optional)";
        this.captionInput.value = this.data.caption || "";
        this.captionInput.addEventListener("input", () => {
            this.data.caption = this.captionInput.value;
        });
        this.captionInput.addEventListener("keydown", (event) => {
            if (
                event.key === "Backspace" &&
                this.captionInput.value.trim() === ""
            ) {
                event.preventDefault();
                this.api.blocks.delete();
            } else if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault(); // Prevent default Enter behavior

                if (!this.captionInput.value.trim()) {
                    this.captionInput.placeholder = "";
                    const currentBlockIndex =
                        this.api.blocks.getCurrentBlockIndex(); //try to get index block using apis of editorJS for editing

                    const nextBlockIndex = currentBlockIndex + 1;
                    const nextBlock =
                        this.api.blocks.getBlockByIndex(nextBlockIndex);
                    if (nextBlock) {
                        this.api.caret.setToBlock(nextBlockIndex, "end");
                    }
                }

                if (exists) {
                    this.api.blocks.delete();
                    exists = false;
                } else {
                    console.log("yes");
                }
            }
        });
        this.captionInput.addEventListener("focus", () => {
            if (!this.captionInput.value.trim()) {
                this.captionInput.placeholder = "Enter caption (Optional)";
            }
        });

        captionWrapper.appendChild(this.captionInput);
        this.wrapper.appendChild(captionWrapper);
    }

    focusCaptionInput() {
        setTimeout(() => {
            this.captionInput.focus();
        }, 0);
    }
    //functions from source code of editorJS
    save(blockContent) {
        return {
            url: this.data.url,
            caption: this.data.caption,
        };
    }

    validate(savedData) {
        return !!savedData.url;
    }

    static get sanitize() {
        return {
            url: {},
            caption: {},
        };
    }
}

export default ImageTool;
