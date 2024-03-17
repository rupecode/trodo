import React, {Component} from 'react';
import {RatesList} from "../sw-components";
import {withRouter} from "../hoc-helpers/with-router";

class RatesPage extends Component {
    state = {
        selectedItem: null,
        dateSort: 'DESC',
    };

    onItemSelected = (selectedItem) => {
        this.setState({selectedItem});
    };

    onDateSort = (onDateSort) => {
        if (this.state.dateSort === "ASC") {
            this.setState({dateSort: "DESC"}, () => onDateSort());
        } else {
            this.setState({dateSort: "ASC"}, () => onDateSort());
        }
    }

    render() {
        //this.forceUpdate();

        const { currency } = this.props.router.params;

        const itemList = (<RatesList
            onItemSelected={this.onItemSelected}
            onDateSort={this.onDateSort}
            dateSort={this.state.dateSort}
            currency={currency}/>);

        return (
            <>
                {itemList}
            </>
        );
    }
}

export default withRouter(RatesPage);
