@extends('layout.master')
@section('title', 'Event')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles">
            <div class="wrapper">
                <div class="row" id="row-report">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <?php if ($data['actions'] == 'store') echo 'Tambah';
                                else echo 'Ubah'; ?> Event
                            </header>
                            <div class="panel-body" id="toro-area">
                                <form id="toro-form" method="POST" action="{{ ($data['actions'] == 'store') ? route('events.store') : route('events.update', base64_encode($data['event']->id)) }}" enctype="multipart/form-data">
                                    @if($data['actions']=='update') @method('PUT') @endif
                                    @csrf
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama Event</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama event" data-bind="value: nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea class="textarea form-control" rows="8" id="keterangan" name="keterangan" data-bind="wysiwyg: keterangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter harga" data-bind="value: harga" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Enter lokasi" data-bind="value: lokasi" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <div class="main-img-preview">
                                                <?php if (isset($data['event'])) : ?>
                                                    <?php if ($data['event']->image != NULL) : ?>
                                                        <img id="preview" name="preview" class="thumbnail img-preview" src="{{asset($data['event']->image)}}" title="Preview Foto">
                                                    <?php else : ?>
                                                        <img id="preview" name="preview" class="thumbnail img-preview" src="{{asset('uploads/default.png')}}" title="Preview Logo">
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <img id="preview" name="preview" class="thumbnail img-preview" src="{{asset('uploads/default.png')}}" title="Preview Logo">
                                                <?php endif; ?>
                                            </div>
                                            <input type="file" name="image" id="image" class="form-control" onchange="img_preview(this, 'preview')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" name="status" data-bind="checked: status"> Aktif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="m_category" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="m_categorys" name="m_categorys[]" required data-bind="valueAllowUnset: true, options: $root.availableCategorys, 
                                            optionsText: 'nama', optionsValue: 'id', select2: { placeholder: 'Choose Category', 
                                                allowClear: true, theme: 'bootstrap' }" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="m_type" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="m_types" name="m_types[]" required data-bind="valueAllowUnset: true, options: $root.availableTypes, 
                                            optionsText: 'nama', optionsValue: 'id', select2: { placeholder: 'Choose Type', 
                                                allowClear: true, theme: 'bootstrap' }" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="organizer" class="col-sm-2 col-form-label">Organizer</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="organizers" name="organizers[]" required data-bind="valueAllowUnset: true, options: $root.availableOrganizers, 
                                            optionsText: 'nama', optionsValue: 'id', select2: { placeholder: 'Choose Organizer', 
                                                allowClear: true, theme: 'bootstrap' }" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="submit" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="summary" data-bind="value: ko.toJSON($root)">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footerScripts')
@parent
<link href="{{ asset ('js/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet">

<script src="{{ asset ('js/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset ('js/knockout.js') }}"></script>
<script src="{{ asset ('js/knockout-sortable.js') }}"></script>
<script src="{{ asset ('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset ('js/tinymce/jquery.tinymce.min.js') }}"></script>
@endsection

@section('script')
<script>
    (function($, ko) {
        var binding = {
            'after': ['attr', 'value'],

            'defaults': {
                theme: "modern",
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                ],
                image_advtab: true,
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | qrcode ",
                entity_encoding: "raw",
                external_filemanager_path: "",
                filemanager_title: "ToroERP File Manager",
                external_plugins: {
                    "filemanager": ""
                },
            },

            'extensions': {},

            'init': function(element, valueAccessor, allBindings, viewModel, bindingContext) {
                if (!ko.isWriteableObservable(valueAccessor())) {
                    throw 'valueAccessor must be writeable and observable';
                }

                var options = allBindings.has('wysiwygConfig') ? allBindings.get('wysiwygConfig') : null,

                    ext = allBindings.has('wysiwygExtensions') ? allBindings.get('wysiwygExtensions') : [],

                    settings = configure(binding['defaults'], ext, options, arguments);

                $(element).text(valueAccessor()());
                setTimeout(function() {
                    $(element).tinymce(settings);
                }, 0);
                ko.utils['domNodeDisposal'].addDisposeCallback(element, function() {
                    $(element).tinymce().remove();
                });

                return {
                    controlsDescendantBindings: true
                };
            },

            'update': function(element, valueAccessor, allBindings, viewModel, bindingContext) {
                var tinymce = $(element).tinymce(),
                    value = valueAccessor()();

                if (tinymce) {
                    if (tinymce.getContent() !== value) {
                        tinymce.setContent(value);
                        tinymce.execCommand('keyup');
                    }
                }
            }

        };

        var configure = function(defaults, extensions, options, args) {
            var config = $.extend(true, {}, defaults);
            if (options) {
                ko.utils.objectForEach(options, function(property) {
                    if (Object.prototype.toString.call(options[property]) === '[object Array]') {
                        if (!config[property]) {
                            config[property] = [];
                        }
                        options[property] = ko.utils.arrayGetDistinctValues(config[property].concat(options[property]));
                    }
                });

                $.extend(true, config, options);
            }
            if (!config['plugins']) {
                config['plugins'] = ['paste'];
            } else if ($.inArray('paste', config['plugins']) === -1) {
                config['plugins'].push('paste');
            }
            var applyChange = function(editor) {
                editor.on('change keyup nodechange', function(e) {
                    args[1]()(editor.getContent());
                    for (var name in extensions) {
                        if (extensions.hasOwnProperty(name)) {
                            binding['extensions'][extensions[name]](editor, e, args[2], args[4]);
                        }
                    }
                });
            };

            if (typeof(config['setup']) === 'function') {
                var setup = config['setup'];
                config['setup'] = function(editor) {
                    setup(editor);
                    applyChange(editor);
                };
            } else {
                config['setup'] = applyChange;
            }

            return config;
        };

        ko.bindingHandlers['wysiwyg'] = binding;

    })(jQuery, ko);

    ko.bindingHandlers.select2 = {
        after: ["options", "value"],
        init: function(el, valueAccessor, allBindingsAccessor, viewModel) {
            $(el).select2(ko.unwrap(valueAccessor()));
            ko.utils.domNodeDisposal.addDisposeCallback(el, function() {
                $(el).select2('destroy');
            });
        },
        update: function(el, valueAccessor, allBindingsAccessor, viewModel) {
            var allBindings = allBindingsAccessor();
            var select2 = $(el).data("select2");
            if ("value" in allBindings) {
                var newValue = "" + ko.unwrap(allBindings.value);
                if ((allBindings.select2.multiple || el.multiple) && newValue.constructor !== Array) {
                    select2.val([newValue.split(",")]);
                } else {
                    select2.val([newValue]);
                }
            }
        }
    };

    function img_preview(_file, _element) {
        var gb = _file.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(_element);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            } else {
                alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
            }
        }
    };

    function EventViewModel() {
        var self = this;

        self.nama = ko.observable('<?php if (isset($data['event'])) echo $data['event']->nama ?>');
        self.keterangan = ko.observable('<?php if (isset($data['event'])) echo $data['event']->keterangan ?>');
        self.harga = ko.observable('<?php if (isset($data['event'])) echo $data['event']->harga ?>');
        self.lokasi = ko.observable('<?php if (isset($data['event'])) echo $data['event']->lokasi ?>');
        self.status = ko.observable(<?= (isset($data['event'])) ? (($data['event']->status == 1) ? 'true' : 'false') : 'true' ?>);
        self.gambar = ko.observable('<?php if (isset($data['event'])) echo $data['event']->gambar ?>');
        self.type = ko.observable('<?php if (isset($data['event'])) echo $data['event']->type ?>');
        self.event = ko.observable('<?php if (isset($data['event'])) echo $data['event']->category ?>');
        self.oganizers = ko.observable('<?php if (isset($data['event'])) echo $data['event']->oganizers ?>');

        self.availableOrganizers = ko.observableArray(<?php if (isset($data['organizer'])) echo $data['organizer'] ?>);
        self.availableCategorys = ko.observableArray(<?php if (isset($data['categorys'])) echo $data['categorys'] ?>);
        self.availableTypes = ko.observableArray(<?php if (isset($data['type'])) echo $data['type'] ?>);

        
    }

    ko.applyBindings(new EventViewModel());

    $(document).ready(function() {
        var m_types = <?= (isset($data['event'])) ? $data['event']->m_types : json_encode([]) ?>;
        $('#m_types').val(m_types.map(e => e.id)).change();
    });
</script>
@endsection