export default function template(data) {

  console.log('rendering template with data', data);

  return $(`
    <div>

      <h1>Level Solved</h1>

      <p>
        moves: ${data.moves} <br>
        pushes: ${data.pushes} <br>
        time: ${data.time}
      </p>

      <p>

        <button
          id="button-replay-level"
          class="button button-large button-game"
          data-handler="interactive"
          data-event="click"
          data-action="reload"
          title="Reload this level">

          <span class="fa fa-repeat"></span>

        </button>


        <button
          id="button-next-level"
          class="button button-large button-game"
          data-handler="interactive"
          data-event="click"
          data-action="loadNextLevel"
          title="Load next Level">

          <span class="fa fa-forward"></span>

        </button>

      </p>

    </div>
  `);

}
