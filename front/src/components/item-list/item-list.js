import React from 'react';

import './item-list.css';
import PropTypes from "prop-types";

const ItemList = (props) => {
    const {data, onItemSelected, children, onDateSort, handleDateSort, dateSort, currency} = props;
    const items = data.map((item) => {
        const {id} = item;
        const label = children(item);

        return (
            <tr
                key={id}
                onClick={() => onItemSelected(id)}
            >
                {label}
            </tr>
        )
    });

    return (
        <>
            <table className="table">
                <thead className="font-weight-bold bg-light">
                    <tr>
                        <td onClick={() => onDateSort(handleDateSort)} className="pointer"><span className={"sort-" + dateSort}></span>Date</td>
                        <td>EUR to {currency}</td>
                    </tr>
                </thead>
                <tbody>
                    {items}
                </tbody>
            </table>
        </>
    );
}

ItemList.defaultProps = {
    onItemSelected: () => {},
};

ItemList.propTypes = {
    onItemSelected: PropTypes.func,
    data: PropTypes.arrayOf(PropTypes.object).isRequired,
    children: PropTypes.func.isRequired,
}

export default ItemList;
