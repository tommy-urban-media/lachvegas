<?php

global $quiz_data;

$quiz_data = [
  'id' => 1,
  'title' => '',
  'result_text' => [
    0 => 'Es tut mir Leid. Aber du bist eine absolute Niete was das Thema Brüste angeht. Du hast keine einzige Frage richtig beantwortet',
    20 => 'Naja das geht besser oder? Beim nächsten Mal klappt es bestimmt besser.',
    40 => 'Schon ganz gut. Aber steigerungsfähig.',
    60 => 'Gut gemacht. Obwohl die Komplexität der Fragen sehr hoch war hast du viele Fragen richtig beantwortet.',
    80 => 'Sehr Gut. Du kennst dich zum Thema gut aus.',
    100 => 'Perfekt. Du bist der ultimative Brüste-Kenner. Dir kann keine Brust etwas vormachen. Gratulation.',
  ],
  'questions' => [
    [
      'id' => 1,
      'question_text' => 'Eine tägliche Massage der Brüste verringert das Risiko an Brustkrebs zu erkranken.',
      'answer_text' => 'Männern wird es freuen ...',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 2,
      'question_text' => 'Es gibt Frauen die allein durch Nippel-Stimulation der Brust zum Orgasmus kommen können',
      'answer_text' => 'ja, ca. 1% der Frauen können dadurch zum Orgasmus kommen',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 3,
      'question_text' => 'Frauen mit Brüsten die zusammen mehr als 10 Kilogramm wiegen benötigen in den USA einen Waffenschein.',
      'text' => 'Schon mehrfach kam es vor, dass eine Frau ihren ehemals Geliebten mit ihren überdimensionierten Brüsten erschlug oder erwürgte. Aus diesem Grund beschloss die US-Regierung 2003, dass Frauen mit übermäßiger Oberweite von mehr als 10 Kilogramm Gewicht einen amtlichen Waffenschein besitzen müssen.',
      'answer_text' => 'So ein Quatsch. Selbst für Schusswaffen wird in den USA kein Waffenschein benötigt. Zumindest in den meisten US-Bundesstaaten.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'false'
    ],
    /*
    [
      'id' => 4,
      'question_text' => 'Riesenbrüste können vor dem Ertinken retten',
      'answer_text' => 'Einer Urlauberin in Kroatien ist es schon einmal passiert. Besoffen ins Meer gegangen und. Durch den Auftrieb ihrer Glocken ging die Dame nicht unter und konnte o später gerettet werden. Quelle: https://www.berliner-kurier.de/news/kurios--aber-wahr-riesenbrueste-retten-urlauberin-vorm-ertrinken-15264296',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 5,
      'question_text' => 'Zu viel Kaffee lässt Busen schrumpfen',
      'text' => 'Eine Schwedische Studie belegt angeblich dass ein übermäßiger Konsum von Kaffee den Busen von Frauen schrumpefn lässt. Stimmt das oder nicht ?',
      'answer_text' => 'Übrigens: Bei Männern passiert genau das Gegenteil. Quelle: https://www.rtl.de/cms/studie-zu-viel-kaffee-laesst-die-brueste-schrumpfen-4189280.html',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 6,
      'question_text' => 'Männer die täglich auf Brüste starren leben bis zu 5 Jahre länger',
      'answer_text' => 'Es wäre zu schön wenn es so wäre. Aber leider lässt sich der Zusammenhang zwischen Bruststarren und Lebensalter bei Männern wissenschaftlich nicht belegen.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'false'
    ],
    [
      'id' => 7,
      'question_text' => 'Brüste können um bis zu 25% größer werden wenn eine Frau erregt ist',
      'answer_text' => 'Männer aufgepasst! Bei einer weiblichen Erregung schwellen nicht nur Brustwarzen an sondern der gesamte Busen. Gleichzeitig werden die Brüstchen sensibler.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 8,
      'question_text' => 'Brüste machen Männer schlauer',
      'answer_text' => 'Nein leider stimmt as nicht. Aber schön wäre es :)',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'false'
    ],
    [
      'id' => 9,
      'question_text' => 'Muttermilch kann Babys high machen',
      'answer_text' => 'Die Muttermilch enthält Stoffe die ein Baby nicht nur satt sondern auch glücklich und müde machen. Der Effekt ist in gewisserweise ähnlich als wenn man Cannabis konsumiert.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    [
      'id' => 10,
      'question_text' => 'Das öffentliche Zeigen von nackten prallen Brüsten ist in Deutschland erlaubt',
      'answer_text' => 'Stimmt im Prinzip. Es gibt in Deutschland kein Gesetz das dass zeigen nackter Oberweite verbietet. An vielen Stränden oder in Parks ist die blanke Freikörperkultur sogar oft gedultet. Allerdings gibt es Einschränkungen. Menschen können sich belästigt fühlen, wenn eine Frau mit nacktem Oberkörper im Supermarkt an der Kasse steht. In diesem Fall kann der Suermarktbetreiber aufgrund seines Hausrechts die Nacktheit verbieten. Bei Zuwiederhandlung könnte der Supermarkt die Polizei rufen und diese würden ein Platzverweis aussprechen. Zudem käme ein Hausverbot in de Supermarkt dazu. Das Zeigen der Brüste in der Öffentlichkeit ist demnach nicht risikofrei. Wenn deine Freundin beim nächsten Amtsbesuch aufgefordert wird ihre Brüste zu bedecken, kann das mit dem Recht der Hausordnung begründet werden.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ],
    */
    /*
    [
      'id' => 11,
      'question_text' => 'Frauen mit größen Brüsten sind intelligenter als Frauen mit kleinen Brüsten',
      'answer_text' => 'Stimmt im Prinzip.',
      'answers' => [
        [
          'id' => 1,
          'label' => 'Stimmt',
          'value' => 'true'
        ],
        [
          'id' => 2,
          'label' => 'Stimmt nicht',
          'value' => 'false'
        ]
      ],
      'result' => 'true'
    ]
    */
  ]
];

?>