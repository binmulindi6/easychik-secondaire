//joker print

const printable = document.getElementById("printable");
const bulletin = document.getElementById("bulletin");
const btnJokerPrint = document.getElementById("joker-print");
const node = printable &&  printable.cloneNode(true);
const pageNode = printable &&  printable.cloneNode(true);
let page = document.body.innerHTML;

document.addEventListener('DOMContentLoaded', function () {
    // Change the content of the viewport meta tag
    var viewportMetaTag = document.querySelector('meta[name="viewport"]');
    
    if (printable && viewportMetaTag) {
        viewportMetaTag.content = '';
    }
});


btnJokerPrint !== null &&
    btnJokerPrint.addEventListener("click", () => {
        // const node = printable.cloneNode(true);

        // document.body.innerHTML = "";
        // document.body.appendChild(node);

        var nn = window.open('/data/print')
        nn.onload = () => {
            // nn.alert(10); 
            if(bulletin){
                bulletin && (nn.document.body.innerHTML = '')
                nn.document.body.appendChild(node)
            }else{
                nn.document.getElementById('root').appendChild(node)
            }
            nn.print()
        }

    });

// window.addEventListener("beforeprint", (e) => {
//     page = "";
//     document.body.appendChild(node);
//     // alert('oklm tv')
// });

// window.addEventListener("afterprint", (e) => {
//     alert(this);
//     page = "";
//     document.body.appendChild(pageNode);
// });
