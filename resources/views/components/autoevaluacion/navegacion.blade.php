<div>
  <hr class="mt-20">
  <div class="mx-auto mt-5 flex w-96 items-center justify-between">
    {{-- button rounded --}}
    <button id="btn-prev" class="btn-rounded pr-4 disabled">
      <x-heroicon-m-chevron-left class="h-8 w-8" />
      Anterior
    </button>
    <div>
      <span class="font-bold">Pagina <span class="current-page">1</span></span> de <span class="total-page">6</span>
    </div>
    <button id="btn-next" class="btn-rounded pl-4">
      Siguiente
      <x-heroicon-m-chevron-right class="h-8 w-8" />
    </button>
  </div>
</div>
