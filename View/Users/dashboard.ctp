<?php echo $this->element('topbar'); ?>

<div id="example"></div>
<div id="appContainer"></div>


<div class="row">
  <div class="large-6 columns"></div>
  <div class="large-6 columns">
    
    <div>
        <span class = "font-green margin-bottom-05em">POINTS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;500/1000</span>
        <div class="progress success" style = "width:300px">
            <span class="meter" style="width: 50%"></span>
        </div>
    </div>
    
    <div style = "margin-top:10em">
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h5 class = "font-green"><?= strtoupper(__("Position")) ?></h5></li>
            <li><h5 class = "font-green"><?= strtoupper(__("Agent name")) ?></h5></li>
            <li><h5 class = "font-green"><?= strtoupper(__("Points")) ?></h5></li>
	    </ul>
        
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h6><?= strtoupper(__("#1")) ?></h6></li>
            <li><h6><?= strtoupper(__("Berenice Ferreira")) ?></h6></li>
            <li><h6><?= strtoupper(__("500")) ?></h6></li>
	    </ul>
        
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h6><?= strtoupper(__("#2")) ?></h6></li>
            <li><h6><?= strtoupper(__("Pedro Delgado")) ?></h6></li>
            <li><h6><?= strtoupper(__("400")) ?></h6></li>
	    </ul>
        
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h6><?= strtoupper(__("#3")) ?></h6></li>
            <li><h6><?= strtoupper(__("Humberto Valencia")) ?></h6></li>
            <li><h6><?= strtoupper(__("300")) ?></h6></li>
	    </ul>
        
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h6><?= strtoupper(__("#4")) ?></h6></li>
            <li><h6><?= strtoupper(__("Antonio Pires")) ?></h6></li>
            <li><h6><?= strtoupper(__("200")) ?></h6></li>
	    </ul>
        
        <ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
            <li><h6><?= strtoupper(__("#5")) ?></h6></li>
            <li><h6><?= strtoupper(__("Rita Silva")) ?></h6></li>
            <li><h6><?= strtoupper(__("100")) ?></h6></li>
	    </ul>
              
    </div>
    
  </div>
</div>

<script type="text/jsx">

require([webroot+'js/requirejs/bootstrap'], function () {
	require(['immutable', 'lodash', 'sweetalert'], function (Immutable) {

// ReactDOM.render(
//   React.createElement('h1', null, 'Hello, world!'),
//   document.getElementById('example')
// );

/*ReactDOM.render(
        <h1>Hello, world!</h1>,
        document.getElementById('example')
    );
    
    $(function(){
        React.render(
       React.createElement('h1', null, 'Hello, world1!'),
       document.getElementById('example2')
     );
   }
   )*/     
    
ReactDOM.render(
  React.createElement('h1', null, 'GAMEBOARD'),
  document.getElementById('example')
);

var instruments = [
  'kick', 'snare', 'hihat', 'open hihat',
  'clap', 'shaker', 'noise', 'ad lib',
  'piano', 'bass', 'random', 'loud snare'
];

// build a 12 x 12 Grid
var grid = _.map(instruments, (title, index) => {
  return {id: index, title: title, grids: _.map(_.range(12), index => {
    return {id: index, active: false};
  })}
});

var Cell = React.createClass({
    render: function() {
      var divStyle = null,
          classes = this.props.active? 'checked grid' : 'grid';
      
      if (this.props.columnId == 0) {
        divStyle =  {clear: 'right'};
      }

      return (
        <div style={divStyle} 
          onClick={this.props.onClick.bind(null, this.props.rowId, this.props.columnId )} 
          className={classes} 
          id={this.props.columnId}>&nbsp;
        </div>
      );
    }
});

var Row = React.createClass({
  render: function() {
    var columns = this.props.row.get('grids').map(column => {
          return (
              <Cell active={column.get('active')} 
                      onClick={this.props.onClick}
                      columnId={column.get('id')} 
                      rowId={this.props.row.get('id')}/>
          );
        }).toArray();
        
        return (
          <div className='gridRow'>
            <div id={this.props.row.get('id')}></div>
            {columns}
          </div>
        );
  }
});

var Sequencer = React.createClass({
    render: function() {
    
      var rows = this.props.grid.map(row => {
        return (
          <Row row={row} onClick={this.props.onClick} />
        );
      }).toArray();

      return (
          <div className="sequencer">
              {rows}
          </div>
      );
    }
});

var App = React.createClass({
  getInitialState: function() {
    return {
      history: Immutable.List(),
      future: Immutable.List(),
      items: Immutable.fromJS(grid) 
    }
  },
  
  onClick: function(rowId, colId) {
    var newItems = this.state.items.updateIn([rowId, 'grids', colId, 'active'], active => !active);
    
    this.setState({
      history: this.state.history.push(this.state.items),
      items: newItems
    });
    
    swal("Let's start this mission! Click ok to tackle a new challenge");
  },
  
  render: function() {
    return (
      <div>
        <Sequencer onClick={this.onClick} grid={this.state.items} />
      </div>
    );
  }
});

ReactDOM.render(<App/>, window.appContainer);

    });
});

</script>