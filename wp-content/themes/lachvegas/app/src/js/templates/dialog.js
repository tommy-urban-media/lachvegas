
//import TemplateLevelStart from './dialog/level_start';
//import TemplateLevelCompleted from './dialog/level_completed';

export default function template(data) {

  console.log('rendering template with data', data);

  return $(`

    <div class="dialog">

      <div class="dialog-title">${data.title}</div>

      <div class="dialog-content">${data.content}</div>

    </div>

  `);

}
