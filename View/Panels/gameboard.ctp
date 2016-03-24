
	<div id="gameboard">
	</div>

	<script>
/*
 * board.js - Game logic for the board game Go
 */
var Board = function(size) {
    this.current_color = Board.BLACK;
    this.size = size;
    this.board = this.create_board(size);
    this.last_move_passed = false;
    this.in_atari = false;
    this.attempted_suicide = false;
};

Board.EMPTY = 0;
Board.BLACK = 1;
Board.WHITE = 2;

/*
 * Returns a size x size matrix with all entries initialized to Board.EMPTY
 */
Board.prototype.create_board = function(size) {
    var m = [];
    for (var i = 0; i < size; i++) {
        m[i] = [];
        for (var j = 0; j < size; j++)
            m[i][j] = Board.EMPTY;
    }
    return m;
};


var BoardView = React.createClass({
    render: function() {
        var intersections = [];
        for (var i = 0; i < this.props.board.size; i++)
            for (var j = 0; j < this.props.board.size; j++)
                intersections.push(BoardIntersection({
                    board: this.props.board,
                    color: this.props.board.board[i][j],
                    row: i,
                    col: j,
                    onPlay: this.props.onPlay
                }));
        var style = {
            width: this.props.board.size * GRID_SIZE,
            height: this.props.board.size * GRID_SIZE
        };
        return "<div style={style} id=\"board\">{intersections}</div>";
    }
});

var elements = [
                    React.createElement('AlertView', 'board={this.state.board} key=1',null),
                    React.createElement('PassView', 'board={this.state.board} key=2',null),
                    React.createElement('BoardView', 'board={this.state.board} key=3 onPlay={this.onBoardUpdate.bind(this)}',null)
                ];

var ContainerView = React.createClass({
    getInitialState: function() {
        return {'board': this.props.board};
    },
    onBoardUpdate: function() {
        this.setState({"board": this.props.board});
    },
    render: function() {
        return React.createElement('div', null, elements)
       
     }
});


var board = new Board(19);


React.render(
    React.createElement('ContainerView', 'board={board}', null),
    document.getElementById('gameboard')
);

	</script>