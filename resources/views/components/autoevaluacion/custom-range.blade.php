<div {{ $attributes->merge(['class' => 'custom-range lg:w-11/12 mx-auto mt-5']) }}>
  <span class="relative">
    <button class="number">0</button>
    <p class="absolute left-0 mt-3 w-max text-left leading-tight hidden md:block">{{ $pretext }}</p>
  </span>
  <button class="number">1</button>
  <button class="number">2</button>
  <button class="number">3</button>
  <button class="number">4</button>
  <button class="number">5</button>
  <button class="number">6</button>
  <button class="number">7</button>
  <button class="number">8</button>
  <button class="number">9</button>
  <span class="relative">
    <button class="number">10</button>
    <p class="absolute right-0 mt-3 w-max text-right leading-tight hidden md:block">{{ $postext }}</p>
  </span>
</div>
