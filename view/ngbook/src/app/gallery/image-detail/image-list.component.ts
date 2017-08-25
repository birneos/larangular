import { Component, OnInit } from '@angular/core';
import { Image } from '../../models/image';
import {ImageService} from '../../services/image.service';

@Component({
  selector: 'app-image-list',
  templateUrl: './image-list.component.html',
  styles: []
})


export class ImageListComponent implements OnInit {

  images: Image[]=[];
  selectedImaage: Image;


  constructor(private imageService: ImageService) {
   }

  ngOnInit() {

     this.images = this.imageService.getImages();
  }

  onSelectImage(image: Image) {
    //console.log(image);
    this.selectedImaage = image;
}
}
