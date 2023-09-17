<div id="introducing" class="frm-identity p-2 sm:p-5 fixed top-0 left-0 flex justify-center items-center w-screen h-screen bg-slate-500 bg-opacity-30 z-sticky">
    <div class=" bg-white rounded sm:rounded-5 shadow-2xl container p-5 w-6/12">
        <div class="flex flex-row justify-between items-center w-full pl-2 sm:pl-5">
            <span class="font-bold text-base"> Presentation <span class="fa fa-solid fa-video"></span></span>
            <span id="btn-hide-introducing" class="btn-identity font-bold text-5 hover:bg-slate-200 rounded-full px-4 py-3 fa fa-solid fa-close cursor-pointer"></span>
        </div>
        <div class="p-2 sm:p-5 flex items-center justify-center">
            @switch($pagename)
                @case('Dashboard')
                    <div class="flex col justify-center">
                        <span>Bienvenue dans votre système de Gestion D'etablissements Scolaires</span>
                    </div>
                    @break
                @case(2)
                    
                    @break
                @default
                    
            @endswitch
        </div>

    </div>
</div>


<script defer>
    const introducing =  document.getElementById('introducing');
    const btnClose = document.getElementById('btn-hide-introducing');
    const hide = () =>{
        introducing.classList.toggle('hidden');
    }
    
    btnClose.addEventListener('click', ()=>{
        console.log(1010);
        hide();
    })

</script>