/* import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Embed from '@editorjs/embed';
import Delimiter from '@editorjs/delimiter';
import ImageTool from '@editorjs/image';
import CodeTool from '@editorjs/code';
import VideoTool from '@editorjs/video'; */

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('blog-type').addEventListener('change', function () {
        var blogType = this.value;
        var textContent = document.getElementById('text-content');
        var videoContent = document.getElementById('video-content');
        var imageContent = document.getElementById('image-content');

        if (blogType === 'T') {
            textContent.style.display = 'block';
            videoContent.style.display = 'none';
            imageContent.style.display = 'none';
            initializeEditor();
        } else if (blogType === 'V') {
            textContent.style.display = 'none';
            videoContent.style.display = 'block';
            imageContent.style.display = 'block';
        }
    });

    function initializeEditor() {
        const editorHolder = document.getElementById('editor1js');
        if (editorHolder) {
            const editor = new EditorJS({
                holder: 'editorjs',
                tools: {
                    header: Header,
                    list: List,
                    embed: Embed,
                    delimiter: Delimiter,
                    image: ImageTool,
                    code: CodeTool,
                    video: VideoTool
                },
                autofocus: true,
                placeholder: 'Start writing...',
                data: {
                    blocks: [
                        {
                            type: 'header',
                            data: {
                                text: '',
                                level: 2
                            }
                        }
                    ]
                }
            });
        } else {
            console.error('Element with ID "editorjs" is missing.');
        }
    }
});
