<div>
  {{-- {{ $survey }} --}}

  <div class="home min-h-screen p-10">
    <div class="container mx-auto">
      <header>
        <img src="img/logo1_n.svg" alt="">
      </header>

      <div class="mx-auto max-w-[1200px]">
        {{-- portada --}}
        <div id="intro">
          <h1 class="mt-24 text-center font-lust text-5xl">Reflexiona y evalúa tu liderazgo inclusivo
            o
            para la inclusión.</h1>
          <div class="mt-20 gap-10 px-20 lg:flex lg:items-start">
            <div>
              <div class="bocadillo relative w-[500px] rounded border-2 border-dashed border-verde-adecco bg-white p-8 text-2xl">
                <p>
                  <span class="">Diversidad</span> es que te inviten a una fiesta. <span class="text-verde-adecco">Inclusión</span> es que te saquen a bailar, <span
                    class="text-verde-adecco">equidad</span> que se
                  acuerden de poner tu canción preferida y <span class="text-verde-adecco">pertenencia</span>
                  es
                  bailar como si nadie te estuviera mirando.
                </p>
              </div>
              <button id="btn-start"
                class="btn text-base font-normal mt-10 rounded-full border-2 border-verde-adecco bg-verde-adecco text-white hover:border-verde-adecco hover:bg-transparent hover:text-verde-adecco">COMENZAR</button>
            </div>
            {{-- foto --}}
            <img class="img-cover -ml-24 mt-5 h-[600px] max-h-[60vh]" src="img/img_chica.webp" alt="">
          </div>
        </div>

        {{-- contendido de la autevaluacion --}}
        <section class="content-eval min-h-96 hidden w-full rounded-3xl bg-white mt-10 py-10 px-16 shadow-xl">
          <x-autoevaluacion.bloque1 id="block-1" />
          <x-autoevaluacion.bloque2 id="block-2" class="hidden" />
          <x-autoevaluacion.bloque3 id="block-3" class="hidden" />
          <x-autoevaluacion.bloque4 id="block-4" class="hidden" />
          <x-autoevaluacion.bloque5 id="block-5" class="hidden" />
          <x-autoevaluacion.bloque6 id="block-6" class="hidden" />
          <x-autoevaluacion.navegacion />
          <button id="enviar" class="btn btn-primary">Enviar datos</button>
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

        let component = @this;
        let dataAswers = {
          "question-1": "Ad dolor et quo aut ",
          "question-2": "45-54 años",
          "question-3": "Masculino",
          "question-4": "Quo sunt eu dicta co",
          "question-5": "5 estrellas",
          "question-6": "6",
          "question-7": "3",
          "question-8": "4",
          "question-9": "4",
          "question-10": "3",
          "question-11": "3",
          "question-12": "8",
          "question-13": "8",
          "question-14": "8",
          "question-15": "8",
          "question-16": "8",
          "question-17": "8",
          "question-18": "4",
          "question-19": "4",
          "question-20": "4",
          "question-21": "4",
          "question-23": "8",
          "question-24": "7",
          "question-25": "7",
          "question-26": "7",
          "question-27": "7",
        };

        console.log(dataAswers);

        console.log('component data', component.data);

        let totalQuestionsHTML = 0;

        //paginacion
        const totalPage = 6;
        let currentPage = 1;
        const btnNext = $('#btn-next');
        const btnPrev = $('#btn-prev');

        initSurvey();
        irPage(1)

        console.log("🚀 ~ totalQuestionsHTML:", totalQuestionsHTML)

        function initSurvey() {
          // add ids in .question and ansewr
          $$('.question').forEach((question, index) => {
            question.setAttribute('id', `question-${index + 1}`);
            totalQuestionsHTML++;
          })
          // $$('.answer').forEach((answer, index) => {
          //   answer.setAttribute('id', `answer-${index + 1}`);
          // })
        }

        // btn start
        $('#btn-start').addEventListener('click', () => {
          $('#intro').classList.add('hidden');
          $('.content-eval').classList.remove('hidden');
        })

        // SELECT en preguntas de 1 al 10
        $$('.number').forEach(num => {
          num.addEventListener('click', ({
            target
          }) => {
            // console.log("🚀 ~ answer.addEventListener ~ target:", target)
            // buscamos el padre de este elemento
            const questionParent = target.closest('.question');
            // remove clase .selected de this questionParent
            questionParent.querySelectorAll('.number').forEach(number => number.classList.remove('selected'));
            target.classList.add('selected');
          });
        });

        //   PAGINACION
        btnNext.addEventListener('click', () => {
          if (currentPage < totalPage) {
            console.log("🚀 ~ changePage ~ getDataPage:", currentPage)
            //recogemos los datos de las pregutnas de esa pagina
            getDataPage();
            currentPage++;
            changePage();
          }
        })
        btnPrev.addEventListener('click', () => {
          if (currentPage > 1) {
            console.log("🚀 ~ changePage ~ getDataPage:", currentPage)
            //recogemos los datos de las pregutnas de esa pagina
            getDataPage();
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
          //   top page behaviour smooth
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });

        }


        function getDataPage() {
          //si los answer de esa question son inputs o select guardamos el valor
          document.querySelectorAll(`#block-${currentPage} .question`).forEach((question, index) => {

            let answerKey = question.id; // Clave para el objeto
            // Si es un input
            let input = question.querySelector('input[type="text"]');
            if (input) {
              dataAswers[answerKey] = input.value;
            }

            // Si es un select
            let select = question.querySelector('select');
            if (select) {
              // guardar el valor del textos del select
              dataAswers[answerKey] = select.options[select.selectedIndex].text;
            }

            // Si es un radio
            let radioInputs = question.querySelectorAll('input[type="radio"]');
            if (radioInputs.length > 0) {
              radioInputs.forEach(input => {
                if (input.checked) {
                  dataAswers[answerKey] = input.dataset.stars;
                }
              });
            }
            // si es escalas de numeros
            let numbers = question.querySelectorAll('.number');
            if (numbers.length > 0) {
              numbers.forEach(number => {
                if (number.classList.contains('selected')) {
                  dataAswers[answerKey] = number.innerHTML;
                }
              });
            }

          })
          // console.log(dataAswers)
        }

        // Funcines para reducir la seleccion de items del DOM querySelectorAll/querySelector
        function $(selector) {
          return document.querySelector(selector);
        }

        function $$(selector) {
          return document.querySelectorAll(selector);
        }

        // para debug
        function irPage(page) {
          $('#intro').classList.add('hidden');
          $('.content-eval').classList.remove('hidden');
          currentPage = page;
          changePage();
        }
      })
    </script>
  @endscript
</div>
