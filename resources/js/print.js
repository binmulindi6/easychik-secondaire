//joker print

const printable = document.getElementById("printable");
const btnJokerPrint = document.getElementById("joker-print");
const node = printable &&  printable.cloneNode(true);
const pageNode = printable &&  printable.cloneNode(true);
let page = document.body.innerHTML;
btnJokerPrint !== null &&
    btnJokerPrint.addEventListener("click", () => {
        // const node = printable.cloneNode(true);

        // document.body.innerHTML = "";
        // document.body.appendChild(node);

        var nn = window.open('/data/print')
        nn.onload = () => {
            // nn.alert(10); 
            // nn.document.body.appendChild(node)
            nn.document.getElementById('root').appendChild(node)
            nn.print()
            // nn.close()
        }
        // var thedoc = nn.document
        // nn.getElementById('root')

        // const dothis = () => {
        //     alert(printable.innerHTML)
        // }

        // theroot.innerHTML = ' window.onload = ' + dothis.toString() + ';'
        // thedoc.body.appendChild(theroot);

        // window.print();
        


        // let newW = open(btn.id, 'Carte Eleve', '_blank');
        // newW.focus()
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
