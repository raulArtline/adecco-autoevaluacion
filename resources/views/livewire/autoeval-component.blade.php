<div>
  {{-- {{ $survey }} --}}

  <div class="home min-h-dvh p-5 md:p-8 lg:p-10">
    <div class="container mx-auto">
      <header>
        <img src="img/logo1_n.svg" alt="">
      </header>

      <div class="mx-auto max-w-[1200px]">
        {{-- portada --}}
        <div id="intro">
          <h1 class="mt-12 text-center font-lust text-4xl lg:text-5xl">Reflexiona y evalúa tu liderazgo inclusivo
            o
            para la inclusión.</h1>
          <div class="mt-10 lg:mt-20 gap-10 lg:px-20">
            {{-- foto --}}
            <img class="max-w-full h-auto lg:-mt-40" src="img/portada.webp" alt="">
            {{-- boca --}}
            <div class="bocadillo relative z-10 w-full max-w-[750px] mx-auto rounded border-2 border-dashed border-verde-adecco bg-white p-8 text-2xl lg:-mt-32">
              <p>
                <span class="">Diversidad</span> es que te inviten a una fiesta. <span class="text-verde-adecco">Inclusión</span> es que te saquen a bailar, <span
                  class="text-verde-adecco">equidad</span> que se
                acuerden de poner tu canción preferida y <span class="text-verde-adecco">pertenencia</span>
                es
                bailar como si nadie te estuviera mirando.
              </p>
            </div>
            {{-- btn --}}
            <button id="btn-start"
              class="btn text-base font-normal mt-5 mx-auto block rounded-full border-2 border-verde-adecco bg-verde-adecco text-white hover:border-verde-adecco hover:bg-transparent hover:text-verde-adecco">COMENZAR</button>
          </div>
        </div>

        {{-- contendido de la autevaluacion --}}
        <section class="content-eval relative min-h-96 hidden w-full rounded-3xl bg-white mt-5 lg:mt-10 py-5 px-8 lg:px-16 shadow-xl">
          <x-autoevaluacion.bloque1 id="block-1" class="relative" />
          <x-autoevaluacion.bloque2 id="block-2" class="pag relative hidden" />
          <x-autoevaluacion.bloque3 id="block-3" class="pag relative hidden" />
          <x-autoevaluacion.bloque4 id="block-4" class="pag relative hidden" />
          <x-autoevaluacion.bloque5 id="block-5" class="pag relative hidden" />
          <x-autoevaluacion.bloque6 id="block-6" class="pag relative hidden" />
          <x-autoevaluacion.bloque7 id="block-7" class="pag relative hidden" />
          <x-autoevaluacion.navegacion />
          <button id="enviar" class="btn btn-primary hidden">Enviar datos</button>
        </section>

        <section id="resumen" class="hidden">
          <x-autoevaluacion.terminar />
        </section>

      </div>
    </div>
  </div>


  @script
    <script>
      document.addEventListener('livewire:initialized', () => {

        // Runs immediately after Livewire has finished initializing
        // on the page...
        let survey = @json($survey);
        const {
          client,
          question
        } = survey;

        let component = @this;
        let dataAswers = {};

        let resultLevels = [{
            label: 'Compromiso',
            levels: [{
                id: 1,
                text: 'Opositor'
              },
              {
                id: 2,
                text: 'Indiferente'
              },
              {
                id: 3,
                text: 'Neutral'
              },
              {
                id: 4,
                text: 'Aliado/a'
              },
              {
                id: 5,
                text: 'Champion de DE&I'
              },
              {
                id: 6,
                text: 'Activista'
              }
            ]
          },
          {
            label: 'Conocimiento',
            levels: [{
                id: 1,
                text: 'Desinterés o desconocimiento',
                min: 0,
                max: 20
              },
              {
                id: 2,
                text: 'Iniciación',
                min: 21,
                max: 40
              },
              {
                id: 3,
                text: 'Madurez',
                min: 41,
                max: 80
              },
              {
                id: 4,
                text: 'Líder con propósito',
                min: 81,
                max: 100
              },
              {
                id: 5,
                text: 'Nivel de conocimiento suficiente para ser líder inclusivo/a',
                min: 101,
                max: 110
              }
            ]
          },
          {
            label: 'Sesgo',
            levels: [{
                id: 1,
                text: 'Inconsciencia',
                min: 0,
                max: 30
              },
              {
                id: 2,
                text: 'Consciente de la inconsciencia',
                min: 31,
                max: 60
              },
              {
                id: 3,
                text: 'Gran nivel de consciencia',
                min: 61,
                max: 90
              },
              {
                id: 4,
                text: 'Cuidado con el Metasesgo',
                min: 91,
                max: 100
              }
            ]
          },
          {
            label: 'Sensibilidad',
            levels: [{
                id: 1,
                text: 'Baja sensibilidad',
                min: 0,
                max: 35
              },
              {
                id: 2,
                text: 'Sensibilidad moderada',
                min: 36,
                max: 70
              },
              {
                id: 3,
                text: 'Alta sensibilidad',
                min: 71,
                max: 105
              },
              {
                id: 4,
                text: 'Muy alta sensibilidad',
                min: 106,
                max: 140
              }
            ]
          },
          {
            label: 'Contacto',
            levels: [{
                id: 1,
                text: 'Ningún contacto o muy poco contacto',
                min: 0,
                max: 30
              },
              {
                id: 2,
                text: 'Contacto ocasional',
                min: 31,
                max: 60
              },
              {
                id: 3,
                text: 'Contacto habitual',
                min: 61,
                max: 90
              },
              {
                id: 4,
                text: 'Mucho contacto',
                min: 91,
                max: 120
              }
            ]
          }
        ];

        // En las paginas 4 y 5 hay dos sumatorias que dan un nivel según las respuestas del usuario, lo almacenamos en estas variables
        let compromisoLevel = 0;
        let nkowledgeLevel = 0;
        let sesgoLevel = 0;
        let sensibilidadLevel = 0;
        let contactoLevel = 0;
        // debug && console.log(dataAswers);
        let totalQuestionsHTML = 0;
        //paginacion
        const totalPage = 7;
        let currentPage = 1;
        const btnNext = $('#btn-next');
        const btnPrev = $('#btn-prev');

        const debug = true; //true para desbloquer el avance y ver console.log

        initSurvey();
        irPage(1);
        // showFeedbacksLevels();

        debug && console.log("livewire:initialized");
        debug && console.log('component data', component.data);
        debug && console.log("🚀 ~ totalQuestionsHTML:", totalQuestionsHTML)

        // pruebas
        $('#enviar').addEventListener('click', (e) => {
          e.preventDefault(); // Evita el envío del formulario
          component.set('data', dataAswers, false);
          component.saveResults().then((res) => {
            debug && console.log(res)
          });

        })

        function sendData() {
          component.set('data', dataAswers, false);
          component.saveResults().then((res) => {
            debug && console.log(res)
            debug && console.log("🚀 ~ sendData ~ res:", dataAswers)
          });
        }

        function initSurvey() {
          // add ids in .question and ansewr
          $$('.question').forEach((question, index) => {
            question.setAttribute('id', `pregunta-${index + 1}`);
            totalQuestionsHTML++;
          })
          //añadir class required a las .questions a partir de la pagina 3
          $$('.pag').forEach((pag, index) => {
            // mayor que 1 porque el index comienza en 0 y son obligatorias a partir de pag 3
            if (index >= 1) {
              // busca todas las .questions y agragarle la clase .required
              pag.querySelectorAll('.question').forEach(question => {
                if (!debug) question.classList.add('required');
              })
            }
          });
        };


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
            // debug && console.log("🚀 ~ answer.addEventListener ~ target:", target)
            // buscamos el padre de este elemento
            const questionParent = target.closest('.question');

            // remove clase .required
            questionParent.classList.remove('required');
            // remove clase .selected de .number de esta pregunta
            questionParent.querySelectorAll('.number').forEach(number => number.classList.remove('selected'));
            target.classList.add('selected');

            // New, si en pregunta 6, se pulsa en la 1,2,3 mostramos un texarea
            questionParent.querySelectorAll('.number').forEach(number => {
              if (number.classList.contains('selected')) {
                if (number.dataset.id === '1' || number.dataset.id === '2' || number.dataset.id === '3') {
                  //   console.log(questionParent);
                  $('.question-hidden').classList.remove('hidden');
                  $('.question-hidden').closest('.question').classList.remove('required');
                } else {
                  $('.question-hidden').classList.add('hidden');
                  $('.question-hidden').querySelector('textarea').value = ''; //   borrar value text area
                  $('.question-hidden').closest('.question').classList.remove('required');
                }
              }
            })

            checkObligatory(); //comprueba obligatorios
          });
        });

        //   PAGINACION
        btnNext.addEventListener('click', () => {
          // si btnNext is disabled no avances
          if (btnNext.classList.contains('disabled')) return
          getDataPage(); //tratar los datos que tenemos que recoger

          if (currentPage < totalPage) {

            currentPage++;

            changePage();
            debug && console.log("🚀 ~ btnNext click ~ pagina actual:", currentPage)
            // revisamos si hay preguntas obligatorias una vez avanzada la pagina
            checkObligatory();
          } else {
            $('.content-eval').classList.add('hidden');
            $('#resumen').classList.remove('hidden');

            //   top page behaviour smooth
            window.scrollTo({
              top: 0,
              behavior: 'smooth'
            });
            showFeedLevels();
            sendData(); //eviamos los datos a BBDD
          }
        });
        btnPrev.addEventListener('click', () => {
          if (currentPage > 1) {
            //recogemos los datos de las pregutnas de esa pagina
            getDataPage();
            currentPage--;
            debug && console.log("🚀 ~ btnRrev click ~ pagina anterior:", currentPage)
            changePage();
          }
        });


        // FUNCTIONS
        function changePage() {
          $$('article').forEach(question => {
            question.classList.add('hidden');
          })

          $(`#block-${currentPage}`).classList.remove('hidden');

          btnNext.classList.remove('disabled');
          btnPrev.classList.remove('disabled');

          if (currentPage === 1) btnPrev.classList.add('disabled');
          //cambiar el texto por Enviar
          (currentPage === totalPage) ? btnNext.querySelector('p').innerHTML = 'Enviar': btnNext.querySelector('p').innerHTML = 'Siguiente';

          // update current page in html
          $('.current-page').textContent = currentPage;
          $('.total-page').textContent = totalPage;
          //   top page behaviour smooth
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });

        }

        function checkObligatory() {
          let requiredCount = 0;

          document.querySelectorAll(`#block-${currentPage} .question`).forEach((question, index) => {
            if (question.classList.contains('required')) {
              requiredCount++;
            }
          });
          // Si hay al menos una pregunta obligatoria, desactivar el botón
          if (requiredCount > 0) {
            btnNext.classList.add('disabled');
            debug && console.log("Hay preguntas obligatorias.");
            return;
          }

          btnNext.classList.remove('disabled');
          debug && console.log("No hay preguntas obligatorias.");
        }

        function showFeedLevels() {
          debug && console.log("🚀 ~ showfeedbackslevels :")

          // for debug
          //   compromisoLevel = 2;
          //   nkowledgeLevel = 70;
          //   sesgoLevel = 50;
          //   sensibilidadLevel = 100;
          //   contactoLevel = 30;
          console.log({
            compromisoLevel,
            nkowledgeLevel,
            sesgoLevel,
            sensibilidadLevel,
            contactoLevel,
          });

          let compromisoResult = resultLevels
            .find((category) => category.label === 'Compromiso')
            .levels.find((level) => level.id === compromisoLevel);
          let conocimientoResult = getLevelInfo('Conocimiento', nkowledgeLevel);
          let sesgoResult = getLevelInfo('Sesgo', sesgoLevel);
          let sensibilidadResult = getLevelInfo('Sensibilidad', sensibilidadLevel);
          let contactoResult = getLevelInfo('Contacto', contactoLevel);

          $('.compromiso').querySelector(`.feed-${compromisoResult.id}`).classList.add('visible');
          $('.conocimiento').querySelector(`.feed-${conocimientoResult.id}`).classList.add('visible');
          $('.sesgo').querySelector(`.feed-${sesgoResult.id}`).classList.add('visible');
          $('.sensibilidad').querySelector(`.feed-${sensibilidadResult.id}`).classList.add('visible');
          $('.contacto').querySelector(`.feed-${contactoResult.id}`).classList.add('visible');

          //set in dataAswers
          dataAswers['compromiso'] = compromisoResult.text;
          dataAswers['conocimiento'] = conocimientoResult.text;
          dataAswers['sesgo'] = sesgoResult.text;
          dataAswers['sensibilidad'] = sensibilidadResult.text;
          dataAswers['contacto'] = contactoResult.text;

          //   console.log(compromisoResult);
          //   console.log(conocimientoResult);
          //   console.log(sesgoResult);
          //   console.log(sensibilidadResult);
          //   console.log(contactoResult);
        }


        function getLevelInfo(categoryLabel, value) {
          const category = resultLevels.find(category => category.label === categoryLabel);

          if (!category) return null;

          const level = category.levels.find(level => value >= level.min && value <= level.max);

          return level ? {
            id: level.id,
            text: level.text
          } : null;
        }

        function getDataPage() {
          console.log("🚀 ~ getDataPage :")
          //reset sumas
          if (currentPage === 3) compromisoLevel = 0;
          if (currentPage === 4) nkowledgeLevel = 0;
          if (currentPage === 5) sesgoLevel = 0;
          if (currentPage === 6) sensibilidadLevel = 0;
          if (currentPage === 7) contactoLevel = 0;

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

            // si es un textarea
            let textarea = question.querySelector('textarea');
            if (textarea) {
              //   console.log(currentPage);
              if (currentPage === 2) dataAswers['respuesta-abierta-video'] = textarea.value;
              if (currentPage === 3) dataAswers['respuesta-abierta-compromiso'] = textarea.value;
            } else {
              if (currentPage === 2) dataAswers['respuesta-abierta-video'] = '';
              if (currentPage === 3) dataAswers['respuesta-abierta-compromiso'] = '';
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
                  //aprovechamos el bucle para hacer la sumatoria segun la pagina actual
                  if (currentPage === 3) compromisoLevel = parseInt(number.dataset.id);
                  if (currentPage === 4) nkowledgeLevel += parseInt(number.innerHTML);
                  if (currentPage === 5) sesgoLevel += parseInt(number.innerHTML);
                  if (currentPage === 6) sensibilidadLevel += parseInt(number.innerHTML);
                  if (currentPage === 7) contactoLevel += parseInt(number.innerHTML);
                }
              });
            }

          })
          debug && console.log(dataAswers)
          //   debug && console.log("🚀 ~ nkowledgeLevel:", nkowledgeLevel)
          //   debug && console.log("🚀 ~ sesgoLevel:", sesgoLevel)

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
          if (currentPage > totalPage) {
            $('.content-eval').classList.add('hidden');
            $('#resumen').classList.remove('hidden');
            showFeedLevels();

            return;
          }
          changePage();
        }
      });
    </script>
  @endscript
</div>
