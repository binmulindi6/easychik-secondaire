import axios from "axios";

const btnsPresence = document.querySelectorAll('.btn-presence');

btnsPresence && btnsPresence.forEach(btnPres => {
    btnPres.addEventListener('click', (e)=> {
        e.preventDefault();
        
        const id = btnPres.id;
        const frm =  document.getElementById('frm' + id)
        const link  = frm.action;
        const freq = document.getElementById('freq' + id).value;
        const token = document.getElementById('token' + id).value;
        const user = document.getElementById('user' + id).value;
        const typeId = btnPres.attributes.placeholder.value;
        const err = document.getElementById('err' + id)


        // console.log(link)
        // console.log(typeId)
        // console.log(freq)
        // console.log(user)
            axios.post(link,
                {
                    "_token" : token,
                    "freq_id" : freq,
                    "type_id" :  typeId,
                    "user_id" :  user
                }
            ).then(e => {
                console.log(e)
                if(e.data === 'succes'){
                document.getElementById('tr' + id).classList.toggle('hidden');
                }else{
                    err.innerHTML = e.data
                }
            })
            .catch(e => {
                console.log(e)
                err.innerHTML = "Une erreur s'est produite reessayer plus tard"
            })
        
        e.preventDefault();
    }
    )
})