<article {{ $attributes }}>
  <x-autoevaluacion.header title="Datos demográficos" />

  <div class="flex flex-col lg:flex-row justify-between ">
    <div class="w-full lg:w-4/12 text-2xl order-2 lg:order-1">
      <div class="question">
        <p>
          <span class="p-number font-bold">5. </span>
          Antes de comenzar el formulario te invitamos a ver este video que nos ayudará a situarnos en la
          materia.
          <strong>
            ¿De
            qué
            hablamos cuando hablamos de diversidad?
          </strong>
        </p>
        <div>
          <p class="mt-5">
            Si quieres valora esta visión con las estrellas que encontrarás debajo del video.
          </p>
          <div class="answer rating rating-lg mt-5">
            <input type="radio" name="rating" class="rating-hidden" checked />
            <input type="radio" name="rating" data-stars="1 estrella" class="mask mask-star-2 bg-verde-adecco" />
            <input type="radio" name="rating" data-stars="2 estrellas" class="mask mask-star-2 bg-verde-adecco" />
            <input type="radio" name="rating" data-stars="3 estrellas" class="mask mask-star-2 bg-verde-adecco" />
            <input type="radio" name="rating" data-stars="4 estrellas" class="mask mask-star-2 bg-verde-adecco" />
            <input type="radio" name="rating" data-stars="5 estrellas" class="mask mask-star-2 bg-verde-adecco" />
          </div>
        </div>
      </div>

      <div class="question mt-5">
        <p>
          Viendo el video, <strong>¿te gustaría hacer algún comentario o reflexión?</strong>
        </p>
        <textarea class="textarea textarea-bordered mt-5 text-lg w-full" placeholder="Escribe tu respuesta aquí"></textarea>
      </div>

    </div>
    {{-- video --}}
    <div class="w-full lg:w-7/12 order-1 lg:order-2 self-center  mb-5">
      <lite-youtube videoid="t_opaRwRaeI"></lite-youtube>
      {{-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/t_opaRwRaeI?si=gsoJAjadkZC4kzYZ" title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen></iframe> --}}
    </div>

  </div>
</article>
