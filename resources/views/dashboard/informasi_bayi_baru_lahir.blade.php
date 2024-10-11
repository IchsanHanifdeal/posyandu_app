 <x-dashboard.main title="Informasi Ibu Bersalin">
   @foreach (['Daftar_informasi_bayi_baru_lahir'] as $item)
     <div class="flex flex-col border-back rounded-xl w-full">
       <div class="p-5 sm:p-7 bg-white rounded-t-xl">
         <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
           {{ str_replace('_', ' ', $item) }}
         </h1>
         <p class="text-sm opacity-60">
           Jelajahi dan ketahui Informasi seputar Bayi Lahir.
         </p>
       </div>
       <div class="flex flex-col rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
         <div class="overflow-x-auto">
           <table class="table table-zebra w-full">
             <thead>
               <tr>
                 @foreach (['No', 'Nama Materi', 'Materi'] as $header)
                   <th class="uppercase font-bold text-center">{{ $header }}</th>
                 @endforeach
               </tr>
             </thead>
             <tbody id="output_surat"></tbody>
           </table>
         </div>
       </div>
     </div>
   @endforeach
 </x-dashboard.main>

 <script async>
   const container = document.getElementById('output_surat')
   window.onload = async () => await loadSurat({
     api: '/images/informasi/anak/baru_lahir/data.json',
     pdfUrl: '/images/informasi/anak/baru_lahir',
     container
   })
 </script>
