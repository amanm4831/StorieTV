var exist = true;

class VideoTool {
    constructor({ data, api }) {
        this.api = api;
        this.data = data || {};
        this.wrapper = null;
        this.fileInput = null;
        this.videoPlayer = null;
        this.captionInput = null;

        this.triggerFileInput();
    }

    static get toolbox() {
        return {
            title: "Video",
            icon: '<?xml version="1.0" ?><svg class="feather feather-play-circle" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>',
        };
    }

    render() {
        this.wrapper = document.createElement("div");
        this.wrapper.classList.add("ce-tool", "ce-tool--video");

        if (this.data.src) {
            this.videoPlayer = document.createElement("video");
            this.videoPlayer.src = this.data.src;
            this.videoPlayer.controls = true;
            this.videoPlayer.style.maxWidth = "100%";
            this.videoPlayer.style.height = "auto";
            this.wrapper.appendChild(this.videoPlayer);

            this.createCaptionInput();
        }

        return this.wrapper;
    }

    triggerFileInput() {
        exist = true;
        this.fileInput = document.createElement("input");
        this.fileInput.type = "file";
        this.fileInput.accept = "video/*";
        this.fileInput.style.display = "none";
        this.fileInput.addEventListener("change", (event) =>
            this.uploadVideo(event)
        );

        document.body.appendChild(this.fileInput);
        this.fileInput.click();
    }

    uploadVideo(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.data.src = e.target.result;
                this.updateView();
                this.focusCaptionInput();
            };
            reader.readAsDataURL(file);
        }
    }

    updateView() {
        if (!this.wrapper) {
            this.wrapper = document.createElement("div");
        }
        this.wrapper.innerHTML = "";

        if (this.data.src) {
            this.videoPlayer = document.createElement("video");
            this.videoPlayer.src = this.data.src;
            this.videoPlayer.controls = true;
            this.videoPlayer.style.maxWidth = "100%";
            this.videoPlayer.style.height = "auto";
            this.wrapper.appendChild(this.videoPlayer);

            this.createCaptionInput();
        }
    }

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
                event.preventDefault();
                if (!this.captionInput.value.trim()) {
                    this.captionInput.placeholder = "";
                    /*  const currentBlockIndex =
                        this.api.blocks.getCurrentBlockIndex(); //try to get index block using apis of editorJS for editing

                    const nextBlockIndex = currentBlockIndex + 1;
                    const nextBlock =
                        this.api.blocks.getBlockByIndex(nextBlockIndex);
                    if (nextBlock) {
                        this.api.caret.setToBlock(nextBlockIndex, "end");
                    } */
                }
                if (exist) {
                    console.log("exists");
                    this.api.blocks.delete();
                    exist = false;
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

    save(blockContent) {
        return {
            src: this.data.src,
            caption: this.data.caption,
        };
    }

    validate(savedData) {
        return !!savedData.src;
    }

    static get pasteConfig() {
        return {
            tags: ["video"],
        };
    }

    static get sanitize() {
        return {
            src: {},
            caption: {},
        };
    }
}

export default VideoTool;
