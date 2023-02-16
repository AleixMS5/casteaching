<x-casteaching-layout>
<button id="hola">get videos
</button>
<script>

    document.getElementById("hola").addEventListener('click', async function (event){
try {
   const videos= await window.casteaching.videos()
    console.log(videos);
}catch(error){
    console.log(error);
}

    });


</script>
</x-casteaching-layout>
