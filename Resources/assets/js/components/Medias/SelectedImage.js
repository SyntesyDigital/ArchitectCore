import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class SelectedImage extends Component {

    constructor(props)
    {
        super(props);
        this.state = {
          crop  : this.props.crop ?this.props.crop:'original',
        };
        this.changeCrop = this.changeCrop.bind(this);

    }

    renderCropOptions(){
      return (IMAGES_FORMATS.map((item,i) => (
          <option value={item.name} key={i+1}>{item.name+" ("+item.width+"x"+item.height+")"}</option>
        ))
      );
    }

    changeCrop(event){
        event.preventDefault();
        this.setState({
          crop : event.target.value
        }); 
        this.props.handleChangeCrop(event.target.value);
    }

    render() {
        return (
          <div className="image-container">
            <div className="image" style={{backgroundImage:"url("+this.props.url+")"}} ></div>

            {/*
            <a href="" className="btn btn-default"><i className="fa fa-pencil"></i> Editar</a>
            */}

            <ul>
              {this.props.showCropSelector &&  
                <li>
                  <select className="form-control" name="crop" value={this.state.crop} onChange={this.changeCrop} >
                    <option value="original" key={0}>Original</option>
                    {this.renderCropOptions()}
                  </select>
                </li>
              } 
              

              <li>
                <b>{Lang.get('fields.filename')}</b> : {this.props.name}
              </li>
              {/*
              <li>
                <b>Llegenda</b> : Lleganda de la imatge
              </li>
              */}
              <li>
                <b>{Lang.get('fields.original_size')}</b> : {this.props.dimension}
              </li>
              <li>
                <b>{Lang.get('fields.original weight')}</b> : {this.props.filesize}
              </li>
              <li>
                <b>{Lang.get('fields.author')}</b> : {this.props.author}
              </li>
              
              <li>
                <a href="" className="btn btn-link" onClick={this.props.onEdit}><i className="fa fa-pencil"></i> {Lang.get('fields.edit')}</a>
                {/*
                <a href="" className="btn btn-link text-danger"><i className="fa fa-trash"></i> Esborrar</a>
                */}
              </li>
            </ul>
          </div>
        );
    }
}

export default SelectedImage;
