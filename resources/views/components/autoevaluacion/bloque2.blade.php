<article {{ $attributes }}>
    <x-autoevaluacion.header title="Datos demográficos" />

    <div class="flex justify-between">
        <div class="w-4/12 text-2xl">
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
                    <div class="aswer rating rating-lg mt-5">
                        <input type="radio" name="rating" class="rating-hidden" checked />
                        <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                        <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                        <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                        <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                        <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                    </div>
                </div>
            </div>

        </div>
        {{-- video --}}
        <div class="w-7/12">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/t_opaRwRaeI?si=gsoJAjadkZC4kzYZ"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>

    </div>
</article>
