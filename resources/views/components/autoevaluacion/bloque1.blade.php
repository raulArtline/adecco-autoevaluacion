<article {{ $attributes }}>
  <x-autoevaluacion.header title="Datos demográficos">
    Recuerda que este formulario es una herramienta de reflexión personal elaborado por la Fundación
    Adecco y que los resultados serán absolutamente anónimos. Únicamente nos servirán para conocer el nivel de
    compromiso y conocimiento de la Diversidad, Equidad e Inclusión y el nivel de sensibilidad de las empresas con
    determinados grupos sociales y minorías. De esta manera podremos enfocar mejor las estrategias de liderazgo
    inclusivo y ético, la formación y el desarrollo de competencias y comportamientos clave para crear entornos
    empresariales abiertos a la diversidad y más inclusivos.
  </x-autoevaluacion.header>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-10">
    <div class="form-control ">
      <div class="question">
        <div class="label">
          <span class="font-lust"><span class="p-number">1. </span>Nombre</span>
        </div>
        <x-autoevaluacion.custom-input type="text" placeholder="Escribe tu respuesta" class="answer input input-bordered text-lg focus-verde w-full" />
      </div>
    </div>
    {{--  --}}
    <div class="form-control ">
      <div class="question">
        <div class="label">
          <span class="font-lust"><span class="p-number">2. </span>Edad</span>
        </div>
        <x-autoevaluacion.custom-select :options="[
            '1' => 'Menor a 18',
            '2' => '18 - 24 años',
            '3' => '25 - 34 años',
            '4' => '35 - 44 años',
            '5' => '45 - 54 años',
            '6' => '+ de 55 años',
        ]" placeholder="Selecciona edad" class="answer" />

      </div>
    </div>
    {{--  --}}
    <div class="form-control ">
      <div class="question">
        <div class="label">
          <span class="font-lust"><span class="p-number">3. </span>Género</span>
        </div>
        <x-autoevaluacion.custom-select :options="[
            '1' => 'Masculino',
            '2' => 'Femenino',
            '3' => 'Otro',
            '4' => 'Prefiero no especificar',
        ]" placeholder="Selecciona género" class="answer" />
      </div>
    </div>

    {{--  --}}
    <div class="form-control ">
      <div class="question">
        <div class="label">
          <span class="font-lust"><span class="p-number">4. </span>Antigüedad</span>
        </div>
        <x-autoevaluacion.custom-input type="text" placeholder="Escribe tu respuesta" class="answer input input-bordered text-lg focus-verde w-full" />
      </div>
    </div>

  </div>
</article>
