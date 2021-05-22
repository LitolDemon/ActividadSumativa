import { Component, OnInit } from '@angular/core';
import {AbstractControl,FormBuilder,FormGroup,Validators} from "@angular/forms"
import { Nota } from './nota';
import { ServicioNotaService } from "../servicio-nota.service";

@Component({
  selector: 'app-home',
  templateUrl: './inicio.component.html',
  styleUrls: ['./inicio.component.scss']
})
export class InicioComponent implements OnInit {
  screen = 0;
  titulo:AbstractControl;
  estado:AbstractControl;
  descripcion:AbstractControl;

  abierto:Array<Nota>=[];
  enProceso:Array<Nota>=[];
  cerrado:Array<Nota>=[];
  array:Array<Nota>=[];
  array2:Array<Nota>=[];
  nota:Nota | undefined;

  formulario:FormGroup;
  constructor(public fb: FormBuilder, private servicio:ServicioNotaService) {
    this.formulario= this.fb.group({
      titulo:["",[Validators.required]],
      estado:["",[Validators.required]],
      descripcion:["",[Validators.required]]
    });

    this.titulo = this.formulario.controls["titulo"];
    this.estado = this.formulario.controls["estado"];
    this.descripcion = this.formulario.controls["descripcion"];
   }

  

  ngOnInit(): void {
  }

  consultarNotas(){
    this.servicio.consultarNotas().subscribe(datos=>{
      this.abierto=datos[0];
      this.enProceso=datos[1];
      this.cerrado=datos[2];
    });
  }

  crear(){
    let lista:Array<Nota>=[{
      titulo:this.formulario.get("titulo")?.value,
      estado:this.formulario.get("estado")?.value,
      descripcion:this.formulario.get("descripcion")?.value
      }
    ];
    this.servicio.guardarDatos(lista).subscribe(datos=>{
      
    });
    this.consultarNotas();
    this.clrs();
    this.screen=1;
  }

  editar(item:Nota){
    this.screen=2;
    this.nota=item;
  }
  
  adicionar(){
    this.screen=0;
  }
 
  actualizar(){
    let lista:Array<Nota>=[{
      titulo:this.formulario.get("titulo")?.value,
      estado:this.formulario.get("estado")?.value,
      descripcion:this.formulario.get("descripcion")?.value
      }
    ];
    lista[1]=<Nota>this.nota;

    this.servicio.actualizarNota(lista).subscribe(datos=>{
      
    });
    this.clrs();
    this.consultarNotas();
    this.screen=1;
  }

  clrs(){
    this.titulo.setValue("");
    this.descripcion.setValue("");
    this.estado.setValue("Selected");
    this.screen=0;
  }

  eliminar(item:Nota){
    console.log(item);
    let lista:Array<Nota>=[];
    lista.push(item);
    console.log(lista);

    this.servicio.eliminarNota(lista).subscribe(datos=>{
    });
    this.consultarNotas();
 
    this.screen=3;
    
  }

  ok(){
    this.screen=1;

  }
}
