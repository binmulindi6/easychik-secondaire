// const isSelectLink = document.querySelectorAll('.isSelectLink');
const isSelect = document.querySelectorAll('.isSelectLink');

// isSelectLink && isSelectLink.forEach(select => {
//     const link = select.id
//     select.addEventListener('click', ()=>{
//         alert(link);
//     })
// })
// alert('link');

isSelect && isSelect.forEach(select => {
    const id = select.id
    const view = document.getElementById(id+'joker')
    const btn = document.getElementById(id+'btn')
    btn.addEventListener('click', ()=>{
        view.classList.add('hidden')
    })
    console.log('view')
    select.addEventListener('change', ()=>{
        if(select.value === 'isLink'){
            view.classList.remove('hidden')
            // window.location.assign(select.attributes.link.value)
        }
    })
} )