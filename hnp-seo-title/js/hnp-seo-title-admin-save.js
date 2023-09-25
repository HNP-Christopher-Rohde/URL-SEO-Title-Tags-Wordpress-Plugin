document.addEventListener("DOMContentLoaded", function() {
    var container = document.querySelector(".hnp_seo_title_wrap");
    
    var hnp_lightbox = document.createElement("div");
    hnp_lightbox.classList.add("hnp_lightbox");
    container.appendChild(hnp_lightbox);
    
    var message = document.createElement("div");
    message.classList.add("message");
    message.textContent = "Saved";
    hnp_lightbox.appendChild(message);
    
    setTimeout(function() {
        hnp_lightbox.style.display = "none";
    }, 2000); // Anzeigedauer in Millisekunden
});

var cssCode = `
   .hnp_seo_title_wrap {
        position: relative;
    }
    
    .hnp_seo_title_wrap .hnp_lightbox {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: flex-start;
        z-index: 9999;
    }
    
    .hnp_seo_title_wrap .message {
        background-color: #efaa15;
        padding: 18px;
        border-radius: 5px;
        color: #fff;
        font-size: 20px;
		margin-top: 25%;
    }
`;

var style = document.createElement("style");
style.type = "text/css";
style.innerHTML = cssCode;
document.getElementsByTagName("head")[0].appendChild(style);