<style type="text/css">

    #trash {
        background: rgba(255, 0, 0, 0.4);
    }
</style>

<form class="floating-labels mt-5" >
<div class="row">
    <div class="col-2">
        <div class="newWidget grid-stack-item ui-draggable ui-draggable-handle" data-gs-x="0" data-gs-y="0" data-gs-width="1" data-gs-height="1">
            <div class="card-body grid-stack-item-content" id="uuhuhuhuhg" ondragover="event.preventDefault()">
                <div>
                    <i class="fa fa-plus-circle"></i>
                </div>
                <div>
                    <span>Drag me in into the dashboard!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-10">

        <button class="btn btn-default" id="first_widget" value="FirstWidget" href="#">First Widget</button>
        <button class="btn btn-default" id="second_widget" value="SecondWidget" href="#">Second Widget</button>
        <div id="trash" style="padding: 15px; margin-bottom: 15px;" class="text-center ui-droppable">
            <div>
                <i class="fa fa-trash"></i>
            </div>
            <div>
                <span>Drop here to remove the grid item!</span>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-3">

        <div class="form-group mb-5 template" draggable="true">
            <input type="text" class="form-control" id="input1" required>
            <span class="bar"></span>
            <label for="input1">Regular Input</label>
        </div>

    </div>
</div>
<!--<div class="form-group mb-5">
                <input type="password" class="form-control" id="input2" required>
                <span class="bar"></span>
                <label for="input2">Password</label>
            </div>
            <div class="form-group mb-5">
                <input type="text" class="form-control" id="input3" required>
                <span class="bar"></span>
                <label for="input3">Placeholder</label>
            </div>
            <div class="form-group mb-5">
                <input type="text" class="form-control" id="input4" required>
                <span class="bar"></span>
                <label for="input4">Helping text</label>
                <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span> </div>
            <div class="form-group mb-5">
                <input type="text" class="form-control" id="input5" data-toggle="tooltip" data-placement="bottom" title="input with tooltip!!" required>
                <span class="bar"></span>
                <label for="input5">Input with tooltip</label>
            </div>
            <div class="form-group mb-5">
                <select class="form-control p-0" id="input6" required>
                    <option></option>
                    <option>Male</option>
                    <option>Female</option>
                </select><span class="bar"></span>
                <label for="input6">Gender</label>
            </div>
            <div class="form-group mb-1">
                <textarea class="form-control" rows="4" id="input7" required></textarea>
                <span class="bar"></span>
                <label for="input7">Text area</label>
            </div>-->
<div class="row">
    <div class="col-12">

    </div>
</div>

<div class="row">
    <div class="col-12">

    </div>
</div>

<div class="row">
    <div class="col-12">

    </div>
</div>

<div class="row mt-5">
    <div class="col-12" style="">

        <div class="grid-stack" data-gs-width="12" data-gs-animate="yes" style="margin: -10px" style="height: 100%;">
           
            <div class="grid-stack-item" data-gs-x="8" data-gs-y="2" data-gs-width="4" data-gs-height="2">
                <div class="grid-stack-item-content" id="efef1"  ondragover="event.preventDefault()">7</div>
            </div>
            <div class="grid-stack-item" data-gs-x="0" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" id="efef2"  ondragover="event.preventDefault()">8</div>
            </div>
            <div class="grid-stack-item" data-gs-x="4" data-gs-y="4" data-gs-width="4" data-gs-height="2">
                <div class="grid-stack-item-content" id="efef3"  ondragover="event.preventDefault()">9</div>
            </div>
            <div class="grid-stack-item" data-gs-x="8" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" id="div1"  ondragover="event.preventDefault()">10</div>
            </div>
            <div class="grid-stack-item" data-gs-x="10" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" id="efef" ondragover="event.preventDefault()">11</div>
            </div>

        </div>

    </div>
</div>
</form>
<script type="text/javascript">

    $(function()
    {
        var $grid = $('.grid-stack');

        $grid.on('added', function(e, items) { log(' added ', items) });
        $grid.on('removed', function(e, items) { log(' removed ', items) });
        $grid.on('change', function(e, items) { log(' change ', items) });
        function log(type, items) {
            if (!items) { return; }
            var str = '';
            for (let i=0; i<items.length && items[i]; i++) { str += ' (x,y)=' + items[i].x + ',' + items[i].y; }
            console.log(type + items.length + ' items.' + str );
        }

        $grid.gridstack({
            alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            ),
            resizable: {
                handles: 'e, se, s, sw, w'
            },
            removable: '#trash',
            removeTimeout: 100,
            acceptWidgets: '.newWidget'
        });

        $('.newWidget').draggable({
            revert: 'invalid',
            helper: "clone",
            scroll: false,
            appendTo: 'body'
        });



        $('#first_widget').click(function()
        {
            let random=Math.floor((Math.random() * 900000000000) + 1);
            var el = $.parseHTML("<div class='grid-stack-item'><div class='grid-stack-item-content' id='" + random + "' ondragover=\"allowDrop(event)\"></div></div>");
            var grids = $('.grid-stack').data('gridstack');
            grids.addWidget(el, 1, 1, 4, 1, true);

            function allowDrop(ev) {
                ev.preventDefault();
            }
            elemDrop();
        });

        $('#second_widget').click(function()
        {
            let random=Math.floor((Math.random() * 900000000000) + 1);
            var el = $.parseHTML("<div class='grid-stack-item'><div class='grid-stack-item-content' id='" + random + "'></div></div>");
            var grids = $('.grid-stack').data('gridstack');
            grids.addWidget(el, 1, 1, 4, 1, true);

            elemDrop();
        });

        elemDrop();

        $('.template').on('dragstart', function (e)
        {
            e.originalEvent.dataTransfer.setData("text", e.originalEvent.target.outerHTML);
        });

        function elemDrop() {
            $('.grid-stack-item-content').on('drop', function (e)
            {
                let random=Math.floor((Math.random() * 900000000000) + 1);
                e.originalEvent.preventDefault();
                let id = e.originalEvent.dataTransfer.getData("elementID");//console.log(id);
                if (id !== '')
                    $('#' + id).remove();

                let data = e.originalEvent.dataTransfer.getData("text");
                let elem = $('#' + e.target.id);

                elem.append(data);
                elem.find('.template').addClass('element').removeClass('template').attr('id', random);
                elem.find('input').attr('id', 'inp-' + random);
                elem.find('label').attr('for', 'inp-' + random);
                elemDragStart();
            });
        }



        function elemDragStart() {
            $('.element').on('dragstart', function (e)
            {
                e.originalEvent.dataTransfer.setData("text", e.originalEvent.target.outerHTML);console.log(e.originalEvent.target.id);
                e.originalEvent.dataTransfer.setData("elementID", e.originalEvent.target.id);
            });
        }

        $('.grid-stack-item-content').on('dragover', function (e) {
            $(this).submit(function(e){
                e.preventDefault();
                alert('it is working!');
                return  false;
            })

        })


    });
</script>