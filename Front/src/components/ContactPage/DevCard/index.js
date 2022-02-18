import './style.scss';
import PropTypes from 'prop-types';

const DevCard = ({
  name,
  pic,
  role,
  team,
  color,
}) => (
  <div className="teamCard">
    <div className="img">
      <img
        className="fit-picture"
        src={pic}
        alt="team-dev"
      />
    </div>
    <div className="info">
      <h2 className="teamName">{name}</h2>
      <p className="teamRole">{role}</p>
      <p className="team" style={{ backgroundColor: color }}>{team}</p>
    </div>
  </div>

);

DevCard.propTypes = {
  name: PropTypes.string.isRequired,
  pic: PropTypes.string.isRequired,
  role: PropTypes.string.isRequired,
  team: PropTypes.string.isRequired,
  color: PropTypes.string.isRequired,
};

export default DevCard;
