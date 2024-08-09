<article {{ $attributes }}>
    <x-autoevaluacion.header title="Datos demográficos" />

    <div class="flex justify-between">
        <div class="w-4/12 text-2xl">
            <p>
                Antes de comenzar el formulario te invitamos a ver este video que nos ayudará a situarnos en la materia.
                <strong>
                    ¿De
                    qué
                    hablamos cuando hablamos de diversidad?
                </strong>
            </p>
            <p class="mt-5">
                Si quieres valora esta visión con las estrellas que encontrarás debajo del video.
            </p>
            <div class="rating rating-lg mt-5">
                <input type="radio" name="rating" class="rating-hidden" checked />
                <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
                <input type="radio" name="rating" class="mask mask-star-2 bg-verde-adecco" />
            </div>

        </div>
        {{-- video --}}
        <div class="w-7/12">
            <iframe width="100%" allowfullscreen="true" frameborder="0" height="422"
                sandbox="allow-scripts allow-same-origin allow-popups allow-forms allow-presentation"
                src="https://www.youtube.com/embed/t_opaRwRaeI?modestbranding=1&amp;rel=0"
                aria-label="Un video vinculado"></iframe>
        </div>

    </div>
</article>
