@extends('layouts.app')

@section('title','Réservation en ligne')

@section('main')
            
            @include('include.breadcrumb')

             <!-- SECTION CONTENT START -->
                <div class="section-full p-t80 p-b50">
                    
                   <div class="container">
                        <!-- TITLE START-->
                        <div class="section-head text-center">
                            <h1 class="text-uppercase">Réservation en ligne</h1>
                            <div class="wt-separator-outer">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>                            
                            </div>
                            <p>Choisissez un service qui correspond à votre besoin et faites votre réservation maintenant.</p>
                        </div>
                        <!-- TITLE END-->
                        <div class="section-content">

                            <form id="demo-form" class="form-horizontal mb-lg" novalidate>
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label">Nom complet</label>
                                    <div class="col-sm-9">
                                        <input name="name" class="form-control" placeholder="Votre nom complet..." required type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Téléphone</label>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" placeholder="Votre Téléphone..." required type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Service</label>
                                    <div class="col-sm-9">
                                        <select name="service" class="form-control" required>
                                          <option>Choisir un service</option>
                                          <option value="Faux locs">Faux Locs</option>
                                          <option value="Braids">Braids</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Date et heure</label>
                                    <div class="col-sm-9">
                                        <input name="date" class="form-control" type="datetime-local">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Note (optionnel)</label>
                                    <div class="col-sm-9">
                                    <textarea rows="5" class="form-control" placeholder="Taper ici si vous voulez laisser une note..." name="note"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input name="condition" id="condition" class="form-control" type="checkbox">
                                        <label for="condition">J'ai lu et compris les conditions d'utilisations.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="button" class="site-button pull-right">Sauvegarder
                                            <i class="fa fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div> 
                </div> 

@endsection