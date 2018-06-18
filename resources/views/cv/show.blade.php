@extends('layouts.app')



@section('content')


<div class="container" id="app">
    <div class="row">
        <div class="col-md-12">
        

              <div class="panel panel-info">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-md-10"><h3 class="panel-title">Experience</h3></div>
                          <div class="col-md-2 text-right">
                          <button class="btn btn-info" @click="open = true">Ajouter</button>
                          </div>
                      </div>
                  </div>
                  <div class="panel-body">
                  <div v-if="open">

                  <div class="form-group">
                    <label for="">Titre</label>
                    <input type="text" class="form-control" placeholder="le Titre" v-model="experience.titre">
                    </div>
                    <div class="form-group">
                    <label for="">Body</label>
                    <textarea class="form-control" cols="30" rows="5" placeholder="le Contenu"  v-model="experience.body"></textarea>
                    </div>

                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Date debut</label>
                            <input type="date" class="form-control" placehplder="Date Debut"  v-model="experience.debut">
                            </div></div>
                       <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Date fin</label>
                            <input type="date" class="form-control" placehplder="Date Fin"  v-model="experience.fin">
                            </div>
                            </div>
                            </div>
                <button class="btn btn-info btn-block" @click="addExperience">Ajouter</button>   


                 <ul class="list-group">
                     <li class="list-group-item" v-for="experience in experiences">
                         <div class="pull-right">
                             <button class="btn btn-default btn-sm">Editer</button>
                         </div>
                         <h3>@{{ experience.titre }}</h3>
                         <p>@{{ experience.body }}</p>
                         <small>@{{ experience.debut }} - @{{ experience.fin }} </small>
                     </li>
                 </ul>
                  </div>
              </div>
              <hr>
              <div class="panel panel-warning">
                  <div class="panel-heading">
                  <div class="row">
                          <div class="col-md-10"><h3 class="panel-title">Formation</h3></div>
                          <div class="col-md-2 text-right">
                          <button class="btn btn-warning">Ajouter</button>
                          </div>
                      </div>
                      
                  </div>
                  <div class="panel-body">
                  <ul class="list-group">
                     <li class="list-group-item">
                         <div class="pull-right">
                             <button class="btn btn-default btn-sm">Editer</button>
                         </div>
                         <h3>Experience Angular</h3>
                         <p>Some default panel content here. Nulla vitae elit libero, a pharetra augue 
                            Aenean lacinia bibendum nulla sed consectetur,Aenean eu leo quam,
                            Pellentesque  ornare sem lacinia quam venenatis. </p>
                            <small>2017-05-21 - 2017-05-21</small>
                     </li>
                 </ul>
                  </div>
              </div>
              <hr>
              <div class="panel panel-danger">
                  <div class="panel-heading">
                  <div class="row">
                          <div class="col-md-10"><h3 class="panel-title">Portefolio</h3></div>
                          <div class="col-md-2 text-right">
                              <button class="btn btn-danger">Ajouter</button>
                          </div>
                      </div>
                      
                  </div>
                  <div class="panel-body">
                 Examples might be simplified to improve reading and basic understanding. Tutorials, references,                      
                 W3Schools is optimized for learning, testing, and training.
                 but we cannot warrant full correctness of all content.
                  </div>
              </div>
              <hr>
              <div class="panel panel-success">
                  <div class="panel-heading">
                  <div class="row">
                          <div class="col-md-10"><h3 class="panel-title">Competence</h3></div>
                          <div class="col-md-2 text-right">
                              <button class="btn btn-success">Ajouter</button>
                          </div>
                      </div>
                      
                  </div>
                  <div class="panel-body">
                 Examples might be simplified to improve reading and basic understanding. Tutorials, references,                      
                 W3Schools is optimized for learning, testing, and training.
                 but we cannot warrant full correctness of all content.
                  </div>
              </div>
              
        </div>
    </div>
</div>
</div>

@endsection

@section('javascripts')

<!-- <script src="js/vue.js"></script> -->
<script src="{{ asset('js/vue.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    window.Laravel = {!! json_encode([
        'csrfToken'    => csrf_token(),
        'idExperience'  => $id,
        'url'          => url('/')
    ]) !!};
    </script>
<!-- <script src="https://unpkg.com/vue@2.1.6/dist/vue.js"></script> -->

<script>
    // axios.get('/experiences').then(response => this.experiences = response.data);

    var app = new Vue({
      el: '#app',
      data: {
          message: 'Welcome To CvTheque',
          experiences: [],
          open: false,
          experience : {
              id: 0,
              cv_id: window.Laravel.idExperience,
              titre: '',
              body: '',
              debut: '',
              fin: ''
           }
      },
      methods: {
          getExperiences: function() {
              axios.get(window.Laravel.url+'/getexperiences/'+window.Laravel.idExperience)
              .then(response => {
                  //console.log(response.data);
                  this.experiences = response.data;
              })
              .catch(error => {
                  console.log('errors :', error);
              })
          },
          addExperience: function() {
              axios.post(window.Laravel.url+'/addexperience', this.experience)
              .then(response => {
                  if(response.data.etat) {
                      this.open = false;
                      this.experiences.push(this.experience);

                  }
              })
              .catch(error => {
                  console.log(error);
              })
          }
      },
      created:function(){
          this.getExperiences();
          
      }
    });
    
</script>

@endsection
