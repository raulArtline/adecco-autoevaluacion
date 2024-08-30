<div>
  {{-- {{ $survey }} --}}

  <div class="home min-h-screen p-10">
    <div class="container mx-auto">
      <header>
        <img src="img/logo1_n.svg" alt="">
      </header>

      <div class="intro mx-auto max-w-[1200px]">

        <h1 class="mt-24 text-center font-lust text-5xl">Reflexiona y evalúa tu liderazgo inclusivo
          o
          para la inclusión.</h1>

        <div class="mt-20 px-20 lg:flex lg:items-start">
          <div class="bocadillo relative w-[500px] rounded border-2 border-dashed border-verde-adecco bg-white p-8 text-2xl">
            <p>
              <span class="">Diversidad</span> es que te inviten a una fiesta. <span class="text-verde-adecco">Inclusión</span> es que te saquen a bailar, <span
                class="text-verde-adecco">equidad</span> que se
              acuerden de poner tu canción preferida y <span class="text-verde-adecco">pertenencia</span>
              es
              bailar como si nadie te estuviera mirando.
            </p>
          </div>
          {{-- foto --}}
          <img class="-ml-40 mt-5 h-[530px]" src="img/img_chica.webp" alt="">
        </div>

        {{-- contendido de la autevaluacion --}}
        <section class="content-eval min-h-96 w-full rounded-3xl bg-white p-16 shadow-xl">
          <x-autoevaluacion.bloque1 id="block-1" />
          <x-autoevaluacion.bloque2 id="block-2" class="hidden" />
          <x-autoevaluacion.bloque3 id="block-3" class="hidden" />
          <x-autoevaluacion.bloque4 id="block-4" class="hidden" />
          <x-autoevaluacion.bloque5 id="block-5" class="hidden" />
          <x-autoevaluacion.bloque6 id="block-6" class="hidden" />
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


        //paginacion
        const totalPage = 6;
        let currentPage = 1;
        const btnNext = $('#btn-next');
        const btnPrev = $('#btn-prev');



        initSurvey();

        irPage(4)


        function initSurvey() {
          // Ocultar todos los article menos el id=1
          // $$('article').forEach(question => {
          //   question.classList.add('hidden');
          // })
          // Mostrar el primero
          // $('#block-1').classList.remove('hidden');

          // add ids in .question and ansewr
          $$('.question').forEach((question, index) => {
            question.setAttribute('id', `question-${index + 1}`);
          })
          $$('.answer').forEach((answer, index) => {
            answer.setAttribute('id', `answer-${index + 1}`);
          })
        }

        // para debug
        function irPage(page) {
          currentPage = page;
          changePage();
        }

        // SELECT number

        $$('.number').forEach(answer => {
          answer.addEventListener('click', () => {
            // buscamos el id la question padre de este elemento
            const question = answer.closest('.question');
            const questionId = question.id;
            // const questionNumber = questionId.split('-')[1];
            // marcamos con la clase .selected
            $$('.number').forEach(number => {


            })
            // answer.classList.add('selected');


          });
        });

        //   PAGINACION
        btnNext.addEventListener('click', () => {
          if (currentPage < totalPage) {
            currentPage++;
            changePage();
          }
        })
        btnPrev.addEventListener('click', () => {
          if (currentPage > 1) {
            currentPage--;
            changePage();
          }
        })
        // FUNCTIONS
        function changePage() {
          $$('article').forEach(question => {
            question.classList.add('hidden');
          })
          $(`#block-${currentPage}`).classList.remove('hidden');

          btnNext.classList.remove('disabled');
          btnPrev.classList.remove('disabled');
          if (currentPage === 1) btnPrev.classList.add('disabled');
          if (currentPage === totalPage) btnNext.classList.add('disabled');

          // update current page in html
          $('.current-page').textContent = currentPage;
          $('.total-page').textContent = totalPage;

        }

        function $(selector) {
          return document.querySelector(selector);
        }

        function $$(selector) {
          return document.querySelectorAll(selector);
        }
      })
    </script>
  @endscript
</div>
