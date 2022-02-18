import AppHeader from 'src/components/AppHeader';
import Footer from 'src/components/Footer';

import './styles.scss';
import PropTypes from 'prop-types';

import DataInput from './DataInput';

// This component contains the register form page with the user data inputs and a validation button

const AccountCreation = ({
  firstName,
  lastName,
  email,
  password,
}) => (
  <div className="content loginContent">
    <AppHeader />
    <div className="invisible-div" />
    <main className="main">
      <div className="content-container">
        <DataInput firstName={firstName} lastName={lastName} email={email} password={password} />
      </div>
    </main>
    <Footer />
  </div>
);

export default AccountCreation;

AccountCreation.propTypes = {
  firstName: PropTypes.string.isRequired,
  lastName: PropTypes.string.isRequired,
  email: PropTypes.string.isRequired,
  password: PropTypes.string.isRequired,
};
