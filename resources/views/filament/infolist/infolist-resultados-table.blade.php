@php
  // Obtener el valor JSON directamente del registro de la base de datos
  $json = $getRecord()->results;
  // Mostrar el JSON crudo para depurar
  //   echo '<pre>' . var_export($json, true) . '</pre>';
  // Decodificar el JSON
  $resultados = json_decode($json, true);
@endphp

@if ($resultados)

  <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-md" style="padding: 1rem">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <caption class="mb-5 text-lg font-semibold text-left rtl:text-right text-gray-900 dark:text-white">
        Resultados
        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Aquí puedes ver los resultados de la autoevaluación para este usuario.</p>
      </caption>
      <thead class="text-xs text-gray-700 uppercase dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
        <tr>
          <th scope="col" class="px-3 py-3">
            Pregunta
          </th>
          <th scope="col" class="px-3 py-3">
            Respuesta
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($resultados as $pregunta => $valor)
          <tr class=" border-b  dark:border-gray-700">
            <td class="px-3 py-1">
              {{-- {{ $loop->iteration }} --}}
              {{ $pregunta }}
            </td>
            <td class="px-3 py-1">
              {{ $valor }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <p>No hay resultados disponibles para este usuario todavía.</p>
@endif
