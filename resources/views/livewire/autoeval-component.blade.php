<div>
    {{-- {{ $survey }} --}}

    <div class="home p-10 min-h-screen">
        <div class="container mx-auto">
            <header>
                <img src="img/logo1_n.svg" alt="">
            </header>

            <div class="intro max-w-[1200px] mx-auto">

                <h1 class="font-lust text-5xl mt-24 text-center ">Reflexiona y evalúa tu liderazgo inclusivo
                    o
                    para la inclusión.</h1>

                <div class="lg:flex lg:items-start mt-20 px-20">
                    <div
                        class="bocadillo bg-white text-2xl p-8  w-[500px] rounded border-2 border-dashed border-verde-adecco relative">
                        <p>
                            <span class="">Diversidad</span> es que te inviten a una fiesta. <span
                                class="text-verde-adecco">Inclusión</span> es que te saquen a bailar, <span
                                class="text-verde-adecco">equidad</span> que se
                            acuerden de poner tu canción preferida y <span class="text-verde-adecco">pertenencia</span>
                            es
                            bailar como si nadie te estuviera mirando.
                        </p>
                    </div>
                    {{-- foto --}}
                    <img class="h-[575px] -ml-40 mt-5" src="img/img_chica.webp" alt="">
                </div>

                {{-- contendido de la autevaluacion --}}
                <section class="content-eval rounded-3xl bg-white shadow-xl w-full min-h-96 p-16">
                    <x-autoevaluacion.bloque1 />
                    <x-autoevaluacion.bloque2 class="mt-20" />
                    <x-autoevaluacion.bloque3 class="mt-20" />
                    <x-autoevaluacion.bloque4 class="mt-20" />
                    <x-autoevaluacion.bloque5 class="mt-20" />
                    <x-autoevaluacion.bloque6 class="mt-20" />
                    <x-autoevaluacion.navegacion />
                </section>

            </div>
        </div>
    </div>


    @script
        <script>
            document.addEventListener('livewire:initialized', () => {
                // Runs immediately after Livewire has finished initializing
                // on the page...
                console.log("livewire:initialized'");
                let survey = @json($survey);
                const {
                    client,
                    question
                } = survey;
                console.log(question);
            })
        </script>
    @endscript
</div>
