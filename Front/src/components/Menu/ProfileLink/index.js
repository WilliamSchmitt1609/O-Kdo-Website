import PropTypes from 'prop-types';

const ProfileLink = ({ name }) => (

  <p>{name}</p>
);

export default ProfileLink;

ProfileLink.propTypes = {
  name: PropTypes.string.isRequired,
};
