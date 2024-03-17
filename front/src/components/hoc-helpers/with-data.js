import React, {Component, useState} from "react";
import Spinner from "../spinner";
import ErrorIndicator from "../error-indicator";
import ReactPaginate from "react-paginate";
import "./react-paginate.css";
import "./style.css";

const withData = (View) => {
    return class extends Component {

        state = {
            data: null,
            loading: false,
            error: false,
            selected: 0,
        }
        componentDidMount = () => {
            this.update()
        }

        update = () => {
            if (this.state.loading) {
                return;
            }

            this.setState({
                loading: true,
                error: false,
            });

            this.props.getData({page: this.state.selected, ...this.props}).then((data) => {
                this.setState({
                    data: data,
                    loading: false,
                })
            }).catch(() => {
                this.setState({
                    loading: false,
                    error: true,
                })
            });
        }

        componentDidUpdate = (prevProps, prevState, snapshot) => {
            if (this.props.currency !== prevProps.currency) {
                this.update();
            }
        }

        handlePageClick = (event) => {
            this.setState({
                selected: event.selected,
            }, () => {
                this.update();
            });

            return event.selected;
        }

        handleDateSort = (event) => {
            this.update();
        }

        render = () => {
            const {data, loading, error, selected} = this.state;

            if (error) {
                return <ErrorIndicator/>
            }

            if (!data) {
                return
            }

            if (loading) {
                return <Spinner/>
            }

            return (
                <>
                    <h3>1 EUR to {this.props.currency} Exchange Rate</h3>
                    <div className="last-updated">Last updated: {data.data.lastUpdated}</div>

                    <ReactPaginate
                        className="react-paginate"
                        breakLabel="..."
                        nextLabel=">"
                        onPageChange={this.handlePageClick}
                        pageRangeDisplayed={5}
                        pageCount={data.pageCount}
                        previousLabel="<"
                        renderOnZeroPageCount={null}
                        forcePage={selected}
                    />

                    <View {...this.props} data={data.data.currencies} handleDateSort={this.handleDateSort}/>

                    <ReactPaginate
                        className="react-paginate"
                        breakLabel="..."
                        nextLabel=">"
                        onPageChange={this.handlePageClick}
                        pageRangeDisplayed={5}
                        pageCount={data.pageCount}
                        previousLabel="<"
                        renderOnZeroPageCount={null}
                        forcePage={selected}
                    />

                    <span>
                        Minimum: {data.data.minimum} {data.data.currency},
                        Maximum: {data.data.maximum} {data.data.currency},
                        Average: {data.data.average} {data.data.currency}
                    </span>
                </>
            );
        }
    }
}

export default withData;
