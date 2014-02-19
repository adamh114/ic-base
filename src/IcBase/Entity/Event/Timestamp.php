<?php

namespace IcBase\Entity\Event;

class Timestamp
{
	public function prePersist(\Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs)
	{
		$document = $eventArgs->getDocument();

		$mongoDate = new \MongoDate();

		if( method_exists( $document, 'setCreatedAt') ) {
			if($document->getCreatedAt() === null) {
				$document->setCreatedAt($mongoDate);
			}
			
		}
		if( method_exists( $document, 'setUpdatedAt') ) {
			if($document->getUpdatedAt() === null) {
				$document->setUpdatedAt($mongoDate);
			}
		}

		/*
		$md = new \MongoDate();
		$dt = new \DateTime('@'.($md->sec-86400));

		echo $dt->format('Y-m-d H:i:s');

		die;
		\Zend\Debug\Debug::dump($document);
		die;
		*/
	}

	public function preUpdate(\Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs)
	{
		$document = $eventArgs->getDocument();
		if( method_exists( $document, 'setUpdatedAt') ) {

			
			
			if( method_exists( $document, 'setUpdatedAt') ) {
				$mongoDate = new \MongoDate();
				$document->setUpdatedAt($mongoDate);
			}

			$documentManager = $eventArgs->getDocumentManager();
	        $class = $documentManager->getClassMetadata(get_class($document));
	        $documentManager->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);			
		}

	}
}
