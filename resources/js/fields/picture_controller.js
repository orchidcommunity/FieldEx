import {Controller} from "stimulus";
//import {Croppie}    from 'croppie';
import Cropper  from 'cropperjs';

export default class extends Controller {

    /**
     *
     * @type {string[]}
     */
     
    static targets = [
        "source",
        "upload"
    ];

    /**
     *
     */
    connect() {
        let image = this.data.get('image');

        if (image) {
            this.element.querySelector('.picture-preview').src = image;
        } else {
            this.element.querySelector('.picture-preview').classList.add('none');
            this.element.querySelector('.picture-remove').classList.add('none');
        }

        let cropPanel = this.element.querySelector('.upload-panel');
        var previews =  this.element.querySelectorAll('.preview');
        
        var dataX      = this.element.querySelector('.picture-dataX');
        var dataY      = this.element.querySelector('.picture-dataY');
        var dataHeight = this.element.querySelector('.picture-dataHeight');
        var dataWidth  = this.element.querySelector('.picture-dataWidth');
        var dataRotate = this.element.querySelector('.picture-dataRotate');
        var dataScaleX = this.element.querySelector('.picture-dataScaleX');
        var dataScaleY = this.element.querySelector('.picture-dataScaleY');
        
        //var width = this.offsetWidth;
        //var height = this.offsetHeight;   
        cropPanel.width = this.data.get('width');
        cropPanel.height = this.data.get('height');
        console.log("width = " + this.data.get('width'));
        console.log("height = " + this.data.get('height'));
        
      
        
        this.cropper = new Cropper(cropPanel, {
          aspectRatio: this.data.get('width')/this.data.get('height'),
          preview: '.preview',
          
          ready: function () {
              console.log("ready");
            
          },
          crop: function (event) {
              
            var data = event.detail;
            //console.log(data);
            dataX.value = Math.round(data.x);
            dataY.value = Math.round(data.y);
            dataHeight.value = Math.round(data.height);
            dataWidth.value = Math.round(data.width);
            dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
            dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
            dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';

          }
          /*
          crop(event) {
            console.log(event.detail.x);
            console.log(event.detail.y);
            console.log(event.detail.width);
            console.log(event.detail.height);
            console.log(event.detail.rotate);
            console.log(event.detail.scaleX);
            console.log(event.detail.scaleY);
          },*/
        });
        
        let cropper = this.cropper;
        /*
        $(dataRotate).bind("change", function() {
            cropper.rotateTo(dataRotate.value);
        });
        $(dataScaleX).bind("change", function() {
            cropper.scaleX(dataScaleX.value);
        });
        $(dataScaleY).bind("change", function() {
            cropper.scaleY(dataScaleY.value);
        }); 
        */
        
        $(this.element.querySelectorAll('.picture-datas')).bind("change", function() {
            //console.log(cropper.getData());
            cropper.setData({
                x: Math.round(dataX.value),
                y: Math.round(dataY.value),
                width: Math.round(dataWidth.value),
                height:Math.round(dataHeight.value),
                rotate:Math.round(dataRotate.value),
                scaleX:Math.round(dataScaleX.value),
                scaleY:Math.round(dataScaleY.value)
            });
        });  
        
        /*
        this.croppie = new Croppie(cropPanel, {
            viewport: {
                width: this.data.get('width'),
                height: this.data.get('height'),
            },
            boundary: {
                width: '100%',
                height: 500
            },
            enforceBoundary: true
        });
        */
    }

    /**
     * Event for uploading image
     *
     * @param event
     */
    upload(event) {

        if (!event.target.files[0]) {
            return;
        }

        let reader = new FileReader();
        reader.readAsDataURL(event.target.files[0]);

        reader.onloadend = () => {
            //console.log(reader.result);
            this.cropper.replace(reader.result)
            /*
            this.croppie.bind({
                url: reader.result
            });
            */
        };
        //console.log($(this.element.querySelector('.modal')).html());
     

        //$(this.element.querySelector('.modal')).dialog({ modal: true });
       
        //(function( $ ){
        $(this.element.querySelector('.modal')).modal('show');
        //});
    }

    /**
     * Action on click button "Crop"
     */
    crop() {

        this.cropper.getCroppedCanvas({
            width: this.data.get('width'),
            height: this.data.get('height'),
            imageSmoothingQuality: 'medium'
        }).toBlob((blob) => {
            const formData = new FormData();

            formData.append('file', blob);
            formData.append('storage', 'public');
            //formData.append('croppedImage', blob);

            // Use `jQuery.ajax` method
            let element = this.element;

            axios.post(platform.prefix('/systems/files'), formData)
                    .then((response) => {
                    let image = `/storage/${response.data.path}${response.data.name}.${response.data.extension}`;

                    element.querySelector('.picture-preview').src = image;
                    element.querySelector('.picture-preview').classList.remove('none');
                    element.querySelector('.picture-remove').classList.remove('none');
                    element.querySelector('.picture-path').value = image;
                    $(element.querySelector('.modal')).modal('hide');
                });
          /*
            $.ajax('/path/to/upload', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success() {
                    console.log('Upload success');
                },
                error() {
                    console.log('Upload error');
                },
            });
            */
        });

        /*
        this.croppie.result('result', {
            type: 'blob',
            size: 'viewport',
            format: 'png'
        }).then(blob => {

            let data = new FormData();
            data.append('file', blob);
            data.append('storage', 'public');

            let element = this.element;
            axios.post(platform.prefix('/systems/files'), data)
                .then((response) => {

                    let image = `/storage/${response.data.path}${response.data.name}.${response.data.extension}`;

                    element.querySelector('.picture-preview').src = image;
                    element.querySelector('.picture-preview').classList.remove('none');
                    element.querySelector('.picture-remove').classList.remove('none');
                    element.querySelector('.picture-path').value = image;
                    $(element.querySelector('.modal')).modal('hide');
                });
        });
        */
    }

    /**
     *
     */
    clear() {
        this.element.querySelector('.picture-path').value = '';
        this.element.querySelector('.picture-preview').src = '';
        this.element.querySelector('.picture-preview').classList.add('none');
        this.element.querySelector('.picture-remove').classList.add('none');
    }
    
    /**
     * Action on click buttons
     */
    moveleft() {
        this.cropper.move(-10, 0);
    }
    moveright() {
        this.cropper.move(10, 0);
    }    
    moveup() {
        this.cropper.move(0, -10);
    }  
    movedown() {
        this.cropper.move(0, 10);
    }   
    zoomin() {
        this.cropper.zoom(0.1);
    }  
    zoomout() {
        this.cropper.zoom(-0.1);
    }  
    rotateleft() {
        this.cropper.rotate(-5);
    }  
    rotateright() {
        this.cropper.rotate(5);
    } 
    scalex() {
        var dataScaleX = this.element.querySelector('.picture-dataScaleX');
        this.cropper.scaleX(-dataScaleX.value);
    }  
    scaley() {
        var dataScaleY = this.element.querySelector('.picture-dataScaleY');
        this.cropper.scaleY(-dataScaleY.value)
    }
    aspectratiowh () {
        console.log(this.data.get('width')/this.data.get('height'));
        this.cropper.setAspectRatio(this.data.get('width')/this.data.get('height'));
    }
    aspectratiofree () {
        console.log(NaN);
        this.cropper.setAspectRatio(NaN);
    }

    
    
    
}
