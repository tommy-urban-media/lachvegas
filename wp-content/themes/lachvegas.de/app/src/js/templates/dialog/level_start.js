export default function template(data) {

  console.log('rendering template with data', data);

  return $(`
    <div>

      <p>The best result for this level was:</p>
      <p>3:00 Min <br> 56 pushes <br> 143 moves </p>
      <h3>Can you beat it?</h3>
      <p>

        <button
          class="button button-large button-game"
          data-handler="interactive"
          data-event="click"
          data-action="start"
          data-scope="level"
          id="btn-start-game">

          Start Game

        </button>

      </p>

    </div>
  `);

}
