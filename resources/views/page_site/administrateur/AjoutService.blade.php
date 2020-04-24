
<!-- ***** Debut de la nouvelle version ***** -->

@include('secsions/secsionsA/header')
<body class="animsition">
    <div class="page-wrapper">
        @include('secsions/secsionsA/menu')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('secsions/secsionsA/header2',compact('utilisateur'))

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Service</h2>
                                    <a href="#modale" class="modale-trigger">
                                        <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>Ajouter un Service</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modale" id="modale">
                            <div class="modale_dialog">
                                <section class="modale_content">
                                    <header class="modale_header">
                                        <h2 class="modale_title">Ajouter un service</h2>
                                        <a href="#" class="modale_close">&times;</a>
                                    </header>
                                    <div class="modale_body">
                                        <div class="modale_text">
                                                <form action="{{ route('service_root') }}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="cc-payment" class="control-label mb-1"></label>
                                                        <fieldset>
                                                            <div class="upload-btn-wrapper">
                                                                <button class="btn">Image du Service</button>
                                                                <input name="logo" type="file" id="image_uploads" accept="image/*" required="required">
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="cc-name" class="control-label mb-1"></label>
                                                        <textarea name="titre" id="textarea-input" rows="2"  class="form-control" placeholder="Titre du Service" required="required" data-val-required="veuiller entrer le titre du service"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cc-number" class="control-label mb-1"></label>
                                                        <textarea name="detaille" id="textarea-input" rows="4"  class="form-control" placeholder="Detail du Service" required="required" data-val-required="veuiller entrer les detaille du service"></textarea>
                                                    </div>
                                                    <div>
                                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                            <!--<i class="fa fa-lock fa-lg"></i>&nbsp;-->
                                                            <span id="payment-button-amount">VALIDER</span>
                                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                        </button>
                                                    </div>
                                                </form>

                                        </div>
                                    </div>
                                    <footer class="modale_footer"></footer>
                                </section>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-lg-6">
                                    <div class="au-card chart-percent-card">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 tm-b-5">{{ $service->titre }}</h3>
                                            <div class="row no-gutters">
                                                <div class="col-xl-6">
                                                    <div class="chart-note-wrap">
                                                        <div class="chart-note mr-0 d-block">
                                                            <span class="dot dot--blue"></span>
                                                            <p>{{ $service->detail }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="percent-chart">
                                                        <img src="/storage/images/{{ $service->image }}" alt="" style="width: 100px; height: 100px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modifier">
                                            <a href="#">
                                                <button type="button" class="btn btn-outline-primary" disabled>Modifier</button>
                                            </a>
                                        </div>
                                        <div class="suprimer">
                                            <form action="/suprimserv" method="POST">
                                                {{ csrf_field()}}
                                                <input type="hidden" name="idS" value="{{ $service->id}}" />
                                                <button type="submit" class="btn btn-outline-primary" >Suprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @include('secsions/secsionsA/footer')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    @include('secsions/secsionsA/js')
