import React, {Component} from 'react';
import { render } from 'react-dom';
import { TwitterPicker } from 'react-color';


class ColorField extends Component {

  constructor(props){
    super(props);
    console.log('FIELD VALUE',this.props.field);
    this.handleOnChange = this.handleOnChange.bind(this);
    const colors = ['#FFFDB1', '#FFDDE2', '#BFE3ED'];

    this.state = {
      displayColorPicker: false,
      color: this.props.field.value?this.props.field.value[0]:colors[0],
      colors: colors
    };
  }
  
  componentDidMount(){
    var color  = { hex: this.state.color};

    this.handleOnChange(color);
  }

  handleOnChange(color) {
    this.setState({ color: color.hex });
    var field = {
      identifier : this.props.field.identifier,
      value : color.hex
    };

    this.props.onFieldChange(field)
  }

  renderInputs() {

      var error = this.props.errors && this.props.errors[this.props.field.identifier] ? true : false;

    return (
      <div className={'form-group bmd-form-group ' + (error ? 'has-error' : null)} >
         <label htmlFor={this.props.field.identifier} className="bmd-label-floating">{this.props.field.name}</label>

         <TwitterPicker 
          onChange={ this.handleOnChange } colors={this.state.colors} color={this.state.color}
         />

      </div>
    );
  }


  render() {

    const hideTab = this.props.hideTab !== undefined && this.props.hideTab == true ? true : false;

    return (
      <div className="field-item">

        <button style={{display:(hideTab ? 'none' : 'block')}}  id={"heading"+this.props.field.identifier} className="btn btn-link" data-toggle="collapse" data-target={"#collapse"+this.props.field.identifier} aria-expanded="true" aria-controls={"collapse"+this.props.field.identifier}>
          <span className="field-type">
            <i className={"fa "+FIELDS.COLOR.icon}></i> {FIELDS.COLOR.name}
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
export default ColorField;
