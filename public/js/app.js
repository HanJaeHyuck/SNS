// http://jsfiddle.net/zfnj5rv4/
window.addEventListener("load", ()=>{
    const dropZone = document.querySelector(".drop-box");
    const dropList = document.querySelector(".drop-list");

    dropZone.addEventListener("dragover", e => {
        e.preventDefault();
    });

    dropZone.addEventListener("drop", e => {
        e.preventDefault();
        const files = Array.from(e.dataTransfer.files);
        
        loadThumbnail(files);
    });
    

    function loadThumbnail(files){
        files.forEach(async x => {
            let img = await loadFile(x);
            dropList.appendChild(img);

            let formData = new FormData();
            formData.append("file", x);
            $.ajax({
                url:"/upload.php",
                method:"post",
                processData:false,
                contentType: false,
                data:formData,
                success:(json) => {
                    console.log(json);
                }
            });
        });
    }
    
    function loadFile(file){
        return new Promise( (res, rej)=>{
            let reader = new FileReader();

            reader.addEventListener("load", ()=>{
                let img = new Image();
                img.src = reader.result;
                img.addEventListener("load", ()=>{
                    let canvas = document.createElement("canvas"); //이미지 리사이징
                    canvas.width = 100;
                    canvas.height = 100;
                    let ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, 100, 100); 
                    let url = canvas.toDataURL();

                    let thumbImg = new Image();
                    thumbImg.src = url;
                    res(thumbImg);
                });
            });
            reader.readAsDataURL(file);
        });
    }
});


// files.forEach(x => {
    //     let reader = new FileReader();

    //     reader.addEventListener("load", () => {
    //         let img = new Image();
    //         img.src = reader.result;
    //         img.addEventListener("load", () => {
    //             dropList.appendChild(img);
    //         });
    //     });

    //     reader.readAsDataURL(x); //이미지 파일을 읽을때 이렇게 읽는다.
    //     // reader.readAsTex() //파일을 읽을때 사용
    // });


