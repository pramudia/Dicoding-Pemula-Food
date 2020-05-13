using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityStandardAssets.CrossPlatformInput;

public class Airplane : MonoBehaviour {

	[SerializeField]
	float moveSpeed;

	[SerializeField]
	float angularSpeed;

	[SerializeField]
	int winningScore = 7;

	float rotationX;
	Vector2 initPos;
	Rigidbody2D rb;

	public GameObject panelGameOver;
	public Text scoreText;
	public AudioClip gameOver;
	public AudioClip gameWin;
	Text status;
	int score;


    // Use this for initialization
    void Start () {
		score = 0;
		rb = GetComponent<Rigidbody2D> ();
        Vector2 arah = new Vector2(2, 0);
		initPos = transform.position;

		panelGameOver = GameObject.Find ("GameOver");
		panelGameOver.SetActive (false);
    }

	// Update is called once per frame
	void Update()
	{
		rotationX = CrossPlatformInputManager.GetAxis ("Horizontal");
		transform.Rotate(0, 0, rotationX * angularSpeed);
	}		

	void FixedUpdate () {
		rb.velocity = transform.up * moveSpeed;
	}

    private void OnCollisionEnter2D(Collision2D coll){
        if (coll.gameObject.name == "BG3"){
			GameOver("lose");       
        }
		if (coll.gameObject.tag == "key") {
			Destroy (coll.gameObject);
			score += 1;
			scoreText.text = score.ToString();

			if (score == winningScore) {
				GameOver ("win");
			}
		}
      
    }

	private void GameOver(string state){
		panelGameOver.SetActive (true);
		status = GameObject.Find ("Status").GetComponent<Text> ();
		if (state == "win") {
			GetComponent<AudioSource> ().clip = gameWin;
			GetComponent<AudioSource> ().Play ();
			status.text = "YOU   WIN. \n YOU'RE  A   REALLY   WINNER";
		} else if (state == "lose") {
			GetComponent<AudioSource> ().clip = gameOver;
			GetComponent<AudioSource> ().Play ();
			status.text = "YOU   LOSE. \n DON'T   TRY   AGAIN, \n BECAUSE   YOU'RE   A    LOSER";
		}
		this.angularSpeed = 0;
		this.moveSpeed = 0;
		this.rotationX = 0;
		rb.isKinematic = false;
		rb.velocity = Vector3.zero;
    }

}
