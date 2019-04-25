import $ from 'jquery';

export default class InfoBox {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.url = $('#ajax_url').val();

        console.log(this.data);

        this.boxes = []; 
        this.renderedBoxes = [];

        this.observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: [0.0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0]
        };

        this.init();
    }

    init() {
        this.collectBoxes();
        this.initEvents();
    }

    collectBoxes() {
        this.boxes = $('body').find('[data-box]');
        this.boxes.each((i, box) => {
            console.log(box);
            $(box).attr('id', 'box-' + i);
        });
        console.log('collecting boxes ...', this.boxes);
    }

    initEvents() {
        this.boxes.each((i, box) => {
            let observer = new IntersectionObserver(this.intersectionCallback.bind(this), this.observerOptions);
            observer.observe(box);
        });
    }

    intersectionCallback(entries) {
        entries.forEach((entry) => {
            let box = entry.target;
            let visiblePct = (Math.floor(entry.intersectionRatio * 100)) + "%";
            
            if (visiblePct == '100%') {
                if (!this.renderedBoxes.includes($(box).attr('id')) ) {
                    this.loadBoxContent(box);
                } else {
                    console.warn('box already rendered');
                }
                
            }
        });
    }

    loadBoxContent(box) {
        this.renderedBoxes.push($(box).attr('id'));
        setTimeout(() => {
            var size = $(box).data('size');
            $(box).find('.box__stage').html( this.renderFrame(size) );
            $(box).addClass('visible');
        }, 500);
    }

    renderFrame(size) {
        let iframe = $('iframe');
            iframe.attr('class', 'box-iframe');
            iframe.attr('src', $('#blogurl').val() + '/box' + '?size=' + size);
        return iframe;
    }

    loadAsync(callback) {
        $.ajax({
            url: this.url,
            dataType: 'json',
            data: {
                action: 'get_box_content',
                size: 'banner'
            },
            type: 'POST',
            success: (response) => {
                callback(response);
            }, 
            error: (error) => {
              console.warn(error);
            }
        });
    }

}
