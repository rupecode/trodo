import React, {Component} from "react";
import Spinner from "../spinner";
import ErrorIndicator from "../error-indicator";

const postData = (View) => {
    return class extends Component {
        state = {
            data: null,
            loading: false,
            error: false,
        }

        componentDidMount = () => {
            this.update()
        }

        update = () => {

        }
    }
}