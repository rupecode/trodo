import React from 'react';
import {compose, withChildFunction, withData, withApiService} from "../hoc-helpers";
import ItemList from "../item-list";

const render = ({date, rate}) => <><td>{date}</td><td className="list-item">{rate}</td></>;

const mapMethodsToProps = (apiService) => {
    return {getData: apiService.getRates}
}

const RatesList = withApiService(mapMethodsToProps)
(withData(withChildFunction(render)(ItemList)));

export {
    RatesList
}