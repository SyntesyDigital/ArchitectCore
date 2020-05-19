import React, {Component} from 'react';
import { render } from 'react-dom';
//import ReactQuill from 'react-quill';
//import 'react-quill/dist/quill.snow.css';

import CKEditor from '@ckeditor/ckeditor5-react';
import ClassicEditor from 'ckeditor5-build-architect';
import MediaSelectModal from './../../Medias/MediaSelectModal';

class MultimediaField extends Component {

  constructor(props){
    super(props);
    //this.handleOnChange = this.handleOnChange.bind(this);

    var values = this.props.field.value ? this.props.field.value : {};

    for(var key in this.props.translations){
        if(values[key] === undefined) {
            values[key] = '';
        }
    }

    console.log("MultimediaField :: constructor : ",values);

    this.state = {
        value : values,
        displayMediaModal : false
    };

  }

  handleOnChange(language,event,editor) {

    const data = editor.getData();
    console.log("event, language, editor, data", { event, language, editor, data } );
    const {value} = this.state;
    value[language] = data;

    this.props.onFieldChange({
        identifier : this.props.field.identifier,
        value : value
    });
  }

  insertImage(editor,imageUrl) {
    
    editor.model.change( writer => {
        const imageElement = writer.createElement( 'image', {
            src: imageUrl
        } );

        // Insert the image in the current selection location.
        editor.model.insertContent( imageElement, editor.model.document.selection );
    } );
  }

  renderInputs() {

    var inputs = [];

    for(var key in this.props.translations){
      //if(this.props.translations[key]){

        var value = this.props.field.value && this.props.field.value[key] ? this.props.field.value[key] : '';
        var error = this.props.errors && this.props.errors[key] ? this.props.errors[key] : null;
        var self = this;

        inputs.push(
          <div className={'form-group bmd-form-group ' + (error !== null ? 'has-error' : null)} key={key}>
            <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name} - {key}</label>
            <CKEditor
                id={key}
                editor={ ClassicEditor }
                data={value}
                /*
                config={{
                  //toolbar: [ 'heading', '|', "undo", "redo", "bold", "italic", "blockQuote", "imageTextAlternative", "imageUpload", "imageStyle:full", "imageStyle:side", "link", "numberedList", "bulletedList", "mediaEmbed", "insertTable", "tableColumn", "tableRow", "mergeTableCells"],
                  toolbar: [ 'heading', '|', "bold", "italic", "blockQuote", "numberedList", "bulletedList","alignment", "|", "link", "mediaEmbed", "insertTable", "|", "undo", "redo","|","myPlugin"],
                  heading: {
                      options: [
                          { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                          { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                          { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                          { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                          { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                          { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                      ]
                  },
                  alignment: {
                    options: [ 'left', 'right' ]
                  },
                }}
                */
                onInit={ editor => {
                    // You can store the "editor" and use when it is needed.
                    //console.log( 'Editor is ready to use! (editor,id)', editor,editor.id );

                    document.addEventListener('insert-media-'+editor.id,function(e){
                      
                      self.props.onImageSelect(self.props.field,key,function(media){
                        var url = media.urls.large !== undefined ? media.urls.large : media.urls.original;
                        console.log("MultiMediaField :: onImageSelect callback : ",ASSETS+url);
                        self.insertImage(editor,ASSETS+url);
                      });

                    }, false);
                    
                } }
                onChange={this.handleOnChange.bind(this,key)}
                onBlur={ ( event, editor ) => {
                    console.log( 'Blur.', editor );
                } }
                onFocus={ ( event, editor ) => {

                    console.log( 'Focus.', editor );
                } }
                
            /> 
          </div>
        );
        /*
        inputs.push(
        <div className={'form-group bmd-form-group ' + (error !== null ? 'has-error' : null)} key={key}>
         <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name} - {key}</label>
         <ReactQuill
            id={key}
            language={key}
            parent={this}
            value={value}
            onChange={this.handleOnChange}
          />
        </div>
        */
      //}
    }
    return inputs;
  }

  render() {

    const hideTab = this.props.hideTab !== undefined && this.props.hideTab == true ? true : false;

    return (
      <div className="field-item">

        <button  style={{display:(hideTab ? 'none' : 'block')}}  id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+FIELDS.RICHTEXT.icon}></i> {FIELDS.RICHTEXT.name}
          </span>
          <span className="field-name">
            {this.props.field.name}
          </span>
        </button>

        <div id={"collapse"+this.props.field.identifier} className="collapse in" aria-labelledby={"heading"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <div className="field-form">
            {this.renderInputs()}
          </div>
        </div>
      </div>
    );
  }

}
export default MultimediaField;
