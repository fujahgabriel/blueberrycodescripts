import { Component,ElementRef, ViewChild } from  '@angular/core';
import { IonicPage, NavController, NavParams, ToastController, Nav } from  'ionic-angular';
import { HomePage } from '../home/home';
import { LoadingController } from 'ionic-angular';
import {Validators, FormBuilder, FormGroup } from '@angular/forms';
import { RestProvider }  from '../../providers/rest/rest';
import { Storage } from '@ionic/storage';
import { HttpClient, HttpParams , HttpResponse } from '@angular/common/http';
/**
 * Generated class for the RechargemeterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-rechargemeter',
  templateUrl: 'rechargemeter.html',
})
export class RechargemeterPage {
  @ViewChild(Nav) nav: Nav;
  private rctoken : FormGroup;
  recharge:any;
  token:string;
  constructor(public navCtrl: NavController, public navParams: NavParams,
    public toastCtrl: ToastController,
    public loadingCtrl: LoadingController,
    private formBuilder: FormBuilder,
    private storage: Storage,
    public http:  HttpClient,
     public cate: RestProvider
  ) {
  #form validation
    this.rctoken = this.formBuilder.group({
     token: ['',  Validators.compose([Validators.maxLength(24), Validators.pattern('[0-9 ]*'), Validators.required])]
      cardno: ['', Validators.compose([Validators.maxLength(16), Validators.minLength(16), Validators.pattern('[0-9 ]*'), Validators.required])],
      cvc: ['',  Validators.compose([Validators.maxLength(3), Validators.minLength(3), Validators.pattern('[0-9 ]*'), Validators.required])],
      mm: ['',  Validators.compose([Validators.maxLength(2), Validators.minLength(2), Validators.pattern('[0-9 ]*'), Validators.required])],
     yy: ['',  Validators.compose([Validators.maxLength(2), Validators.minLength(2), Validators.pattern('[0-9 ]*'), Validators.required])]
      
  
    });
  }

  ionViewDidLoad() {
  this.recharge='token';
  //console.log('ionViewDidLoad RechargemeterPage');
  }

  swipeEvent(event) {
    if(event.direction === 4) {
      this.navCtrl.setRoot(HomePage);
    }
    
  }

  loadtokensms(){
    var mytoken = this.rctoken.value['token'];
 if(mytoken == "" || mytoken== null){
var text ="token can not be empty";
this.msg(text);
 }else{
  let loading = this.loadingCtrl.create({
    content: 'recharging...',
    duration: (Math.random() * 1000) + 500
  });
  loading.present();
    
  this.storage.get('meterid').then((val) => {
    var key=this.key.value;
    var to='2340000000000';
        var msg='*02%23'+mytoken;
        var from ='Test';
        var url ='https://smsgatway.com/api/sms/send?key='+key+'&to='+to+'&text='+ msg+'&from='+from+'&type=json';
        this.http.get(url).subscribe(data => {
   
      loading.dismiss();
 
            
            var text ='Meter recharged';
          this.msg(text);

       
     
    }, (err) => {
      var text ="Error occurred! Try Later.";
      this.msg(text);
    });
  
  });
 }

  }

  msg(res){
    let toast = this.toastCtrl.create({
      message: res,
      duration: 5000,
      position: 'top'
    });
    toast.present();
  }
}
